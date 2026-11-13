<?php

/**
 * Integrasi RajaOngkir (Komerce) untuk menghitung ongkos kirim POS Indonesia.
 *
 * Alur kerja:
 *   1. Tentukan ID destinasi asal (Kota Kupang) — dari config atau deteksi otomatis.
 *   2. Cari ID destinasi tujuan berdasarkan kelurahan/kecamatan/kabkota pada data_komdanas.
 *   3. Hitung ongkos kirim kurir POS Indonesia (default) untuk berat tertentu.
 *
 * Semua hasil di-cache pada tabel `rajaongkir_cache` agar tidak memanggil API berulang.
 * Jika API gagal / belum dikonfigurasi, fungsi mengembalikan 0 tanpa menghentikan aplikasi.
 *
 * Dokumentasi: https://rajaongkir.com/docs/shipping-cost/getting_started/about
 */

if (!function_exists('db_con')) {
    require_once __DIR__ . '/fungsi.php';
}

/**
 * Ambil konfigurasi RajaOngkir dari config.php (fallback ke environment variable).
 */
function rajaongkir_config()
{
    static $cfg = null;
    if ($cfg !== null) {
        return $cfg;
    }

    $cfg = [
        'api_key'  => '',
        'base_url' => 'https://rajaongkir.komerce.id/api/v1',
        'origin'   => 0,
        'weight'   => 1000,
        'courier'  => 'pos',
        'timeout'  => 15,
    ];

    $file = __DIR__ . '/config.php';
    if (is_file($file)) {
        $c = require $file;
        if (is_array($c)) {
            if (!empty($c['rajaongkir_api_key'])) {
                $cfg['api_key'] = (string) $c['rajaongkir_api_key'];
            }
            if (!empty($c['rajaongkir_base_url'])) {
                $cfg['base_url'] = rtrim((string) $c['rajaongkir_base_url'], '/');
            }
            if (isset($c['rajaongkir_origin'])) {
                $cfg['origin'] = (int) $c['rajaongkir_origin'];
            }
            if (!empty($c['rajaongkir_weight'])) {
                $cfg['weight'] = (int) $c['rajaongkir_weight'];
            }
            if (!empty($c['rajaongkir_courier'])) {
                $cfg['courier'] = (string) $c['rajaongkir_courier'];
            }
        }
    }

    if ($cfg['api_key'] === '') {
        $env = getenv('RAJAONGKIR_API_KEY');
        if ($env !== false && $env !== '') {
            $cfg['api_key'] = (string) $env;
        }
    }

    return $cfg;
}

/**
 * Apakah API key RajaOngkir sudah tersedia.
 */
function rajaongkir_is_configured()
{
    $cfg = rajaongkir_config();
    return $cfg['api_key'] !== '';
}

/**
 * Pastikan tabel cache tersedia (dibuat otomatis bila belum ada).
 */
function rajaongkir_ensure_cache_table()
{
    static $done = false;
    if ($done) {
        return;
    }
    $con = db_con();
    $sql = "CREATE TABLE IF NOT EXISTS rajaongkir_cache (
        cache_key VARCHAR(191) NOT NULL,
        destination_id INT NULL,
        cost INT NOT NULL DEFAULT 0,
        etd VARCHAR(50) NULL,
        service VARCHAR(100) NULL,
        updated_at DATETIME NOT NULL,
        PRIMARY KEY (cache_key)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    @mysqli_query($con, $sql);
    $done = true;
}

/**
 * Ambil entri cache yang masih berlaku (null bila tidak ada / kedaluwarsa).
 */
function rajaongkir_cache_get($key, $ttl)
{
    rajaongkir_ensure_cache_table();
    $con = db_con();
    $stmt = mysqli_prepare($con, "SELECT destination_id, cost, etd, service, updated_at FROM rajaongkir_cache WHERE cache_key=? LIMIT 1");
    if ($stmt === false) {
        return null;
    }
    mysqli_stmt_bind_param($stmt, 's', $key);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);

    if (!$row) {
        return null;
    }
    $ts = strtotime($row['updated_at']);
    if ($ts === false || (time() - $ts) > (int) $ttl) {
        return null;
    }
    return $row;
}

/**
 * Simpan / perbarui entri cache.
 */
function rajaongkir_cache_set($key, $destination_id, $cost, $etd, $service)
{
    rajaongkir_ensure_cache_table();
    $con = db_con();
    $now = date('Y-m-d H:i:s');
    $sql = "INSERT INTO rajaongkir_cache (cache_key, destination_id, cost, etd, service, updated_at)
            VALUES (?,?,?,?,?,?)
            ON DUPLICATE KEY UPDATE
                destination_id=VALUES(destination_id),
                cost=VALUES(cost),
                etd=VALUES(etd),
                service=VALUES(service),
                updated_at=VALUES(updated_at)";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        return;
    }
    $dest    = ($destination_id === null) ? null : (int) $destination_id;
    $cost    = (int) $cost;
    $etd     = ($etd === null) ? null : (string) $etd;
    $service = ($service === null) ? null : (string) $service;
    mysqli_stmt_bind_param($stmt, 'siisss', $key, $dest, $cost, $etd, $service, $now);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

/**
 * Pastikan tabel cache hasil pencarian destinasi tersedia.
 *
 * Pencarian destinasi (GET /destination/domestic-destination) juga memakan
 * kuota hit. Karena itu hasilnya disimpan agar kata kunci yang sama tidak
 * memanggil API berulang kali.
 */
function rajaongkir_ensure_search_table()
{
    static $done = false;
    if ($done) {
        return;
    }
    $con = db_con();
    $sql = "CREATE TABLE IF NOT EXISTS rajaongkir_search_cache (
        cache_key VARCHAR(191) NOT NULL,
        payload MEDIUMTEXT NOT NULL,
        updated_at DATETIME NOT NULL,
        PRIMARY KEY (cache_key)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    @mysqli_query($con, $sql);
    $done = true;
}

/**
 * Ambil hasil pencarian destinasi dari cache (null bila tidak ada/kedaluwarsa).
 */
function rajaongkir_search_cache_get($key, $ttl)
{
    rajaongkir_ensure_search_table();
    $con = db_con();
    $stmt = mysqli_prepare($con, "SELECT payload, updated_at FROM rajaongkir_search_cache WHERE cache_key=? LIMIT 1");
    if ($stmt === false) {
        return null;
    }
    mysqli_stmt_bind_param($stmt, 's', $key);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);

    if (!$row) {
        return null;
    }
    $ts = strtotime($row['updated_at']);
    if ($ts === false || (time() - $ts) > (int) $ttl) {
        return null;
    }
    $data = json_decode($row['payload'], true);
    return is_array($data) ? $data : null;
}

/**
 * Simpan hasil pencarian destinasi ke cache.
 */
function rajaongkir_search_cache_set($key, $data)
{
    rajaongkir_ensure_search_table();
    $con = db_con();
    $now = date('Y-m-d H:i:s');
    $payload = json_encode($data);
    if ($payload === false) {
        return;
    }
    $sql = "INSERT INTO rajaongkir_search_cache (cache_key, payload, updated_at)
            VALUES (?,?,?)
            ON DUPLICATE KEY UPDATE payload=VALUES(payload), updated_at=VALUES(updated_at)";
    $stmt = mysqli_prepare($con, $sql);
    if ($stmt === false) {
        return;
    }
    mysqli_stmt_bind_param($stmt, 'sss', $key, $payload, $now);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

/**
 * Normalisasi teks untuk pencocokan (huruf kecil, tanpa tanda baca).
 */
function rajaongkir_norm($s)
{
    $s = strtolower(trim((string) $s));
    $s = preg_replace('/[^a-z0-9]+/', ' ', $s);
    return trim(preg_replace('/\s+/', ' ', $s));
}

/**
 * Normalisasi sekaligus membuang prefiks administratif (Kel., Desa, Kec., Kota, Kab.).
 */
function rajaongkir_strip($s)
{
    $s = rajaongkir_norm($s);
    $s = preg_replace('/^(kelurahan|kel|desa|kecamatan|kec|kota|kabupaten|kab)\s+/', '', $s);
    return trim($s);
}

/**
 * Penghitung jumlah panggilan HTTP nyata ke API RajaOngkir pada satu request PHP.
 * Berguna untuk diagnostik berapa "hit" yang dikonsumsi tiap proses.
 *
 * @param bool $reset Set true untuk mengembalikan hit ke 0.
 * @param bool $increment Set true untuk menambah hit sebanyak 1.
 * @return int Jumlah hit saat ini.
 */
function rajaongkir_api_hits($reset = false, $increment = false)
{
    static $hits = 0;
    if ($reset) {
        $hits = 0;
    }
    if ($increment) {
        $hits++;
    }
    return $hits;
}

/**
 * Permintaan HTTP ke API RajaOngkir.
 *
 * @return array|null Array hasil decode JSON, atau null bila gagal.
 */
function rajaongkir_http($method, $path, $params = [])
{
    $cfg = rajaongkir_config();
    if ($cfg['api_key'] === '') {
        error_log('RajaOngkir: API key belum diatur pada config.php.');
        return null;
    }
    if (!function_exists('curl_init')) {
        error_log('RajaOngkir: ekstensi cURL tidak tersedia.');
        return null;
    }

    $url = $cfg['base_url'] . $path;
    $ch  = curl_init();
    $headers = [
        'key: ' . $cfg['api_key'],
        'Accept: application/json',
    ];

    if (strtoupper($method) === 'GET') {
        if (!empty($params)) {
            $url .= (strpos($url, '?') === false ? '?' : '&') . http_build_query($params);
        }
        curl_setopt($ch, CURLOPT_HTTPGET, true);
    } else {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    }

    curl_setopt_array($ch, [
        CURLOPT_URL            => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_TIMEOUT        => (int) $cfg['timeout'],
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => true,
        CURLOPT_SSL_VERIFYHOST => 2,
    ]);

    // Catat hit nyata ke API (dipanggil tepat sebelum request dikirim).
    $hits = rajaongkir_api_hits(false, true);
    error_log(sprintf('RajaOngkir hit #%d: %s %s', $hits, strtoupper($method), $path));

    $body   = curl_exec($ch);
    $errno  = curl_errno($ch);
    $error  = curl_error($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($body === false || $errno !== 0) {
        error_log('RajaOngkir cURL error: ' . $error);
        return null;
    }

    $json = json_decode($body, true);
    if (!is_array($json)) {
        error_log('RajaOngkir: respons bukan JSON (HTTP ' . $status . ').');
        return null;
    }
    if ($status < 200 || $status >= 300) {
        $msg = isset($json['meta']['message']) ? $json['meta']['message'] : ('HTTP ' . $status);
        error_log('RajaOngkir HTTP error: ' . $msg);
        return null;
    }

    return $json;
}

/**
 * Cari destinasi domestik berdasarkan kata kunci.
 *
 * Hasil disimpan di cache (TTL 30 hari) karena endpoint pencarian juga
 * memakan kuota hit API.
 */
function rajaongkir_search_destination($keyword, $limit = 10)
{
    $key = 'search:' . md5(strtolower(trim((string) $keyword)) . '|' . (int) $limit);
    $cached = rajaongkir_search_cache_get($key, 2592000);
    if ($cached !== null) {
        return $cached;
    }

    $json = rajaongkir_http('GET', '/destination/domestic-destination', [
        'search' => $keyword,
        'limit'  => (int) $limit,
        'offset' => 0,
    ]);
    if ($json === null) {
        return [];
    }
    $data = isset($json['data']) ? $json['data'] : [];
    $data = is_array($data) ? $data : [];

    // Simpan juga hasil kosong agar pencarian gagal tidak diulang terus.
    rajaongkir_search_cache_set($key, $data);
    return $data;
}

/**
 * Tentukan ID destinasi tujuan dari data kelurahan/kecamatan/kabkota/provinsi.
 *
 * @return array|null Baris destinasi terbaik, atau null bila tidak yakin.
 */
function rajaongkir_resolve_destination($kel, $kec, $kabkota, $prop)
{
    $kel_n  = rajaongkir_norm($kel);
    $kel_s  = rajaongkir_strip($kel);
    $kec_n  = rajaongkir_norm($kec);
    $kec_s  = rajaongkir_strip($kec);
    $kab_n  = rajaongkir_norm($kabkota);
    $kab_s  = rajaongkir_strip($kabkota);
    $prop_n = rajaongkir_norm($prop);

    $queries = [];
    if ($kel_s !== '') {
        $queries[] = trim($kel_s . ' ' . $kec_s);
        $queries[] = $kel_s;
    }
    if ($kec_s !== '') {
        $queries[] = trim($kec_s . ' ' . $kab_s);
    }
    $queries = array_values(array_unique(array_filter($queries)));

    $best       = null;
    $best_score = -1;

    foreach ($queries as $q) {
        $results = rajaongkir_search_destination($q, 15);
        foreach ($results as $r) {
            if (!is_array($r)) {
                continue;
            }
            $r_sub  = rajaongkir_norm(isset($r['subdistrict_name']) ? $r['subdistrict_name'] : '');
            $r_dis  = rajaongkir_norm(isset($r['district_name']) ? $r['district_name'] : '');
            $r_city = rajaongkir_norm(isset($r['city_name']) ? $r['city_name'] : '');
            $r_prov = rajaongkir_norm(isset($r['province_name']) ? $r['province_name'] : '');

            $score = 0;
            $sub_matched = false;
            $dis_matched = false;

            if ($kel_s !== '' && $r_sub === $kel_s) {
                $score += 4;
                $sub_matched = true;
            } elseif ($kel_s !== '' && $r_sub !== '' && strpos($r_sub, $kel_s) !== false) {
                $score += 2;
                $sub_matched = true;
            }

            if ($kec_s !== '' && $r_dis === $kec_s) {
                $score += 3;
                $dis_matched = true;
            } elseif ($kec_s !== '' && $r_dis !== '' && strpos($r_dis, $kec_s) !== false) {
                $score += 1;
                $dis_matched = true;
            }

            if ($kab_n !== '' && $r_city === $kab_n) {
                $score += 2;
            } elseif ($kab_s !== '' && $r_city !== '' && rajaongkir_strip($r_city) === $kab_s) {
                $score += 1;
            }

            if ($prop_n !== '' && $r_prov === $prop_n) {
                $score += 1;
            }

            // Wajib ada kecocokan kelurahan atau kecamatan agar tidak salah pilih.
            if (!$sub_matched && !$dis_matched) {
                continue;
            }

            if ($score > $best_score) {
                $best_score = $score;
                $best = $r;
            }
        }

        if ($best_score >= 7) {
            break;
        }
    }

    if ($best === null || $best_score < 4) {
        return null;
    }
    return $best;
}

/**
 * Tentukan ID destinasi asal (Kota Kupang).
 */
function rajaongkir_origin_id()
{
    $cfg = rajaongkir_config();
    if ($cfg['origin'] > 0) {
        return $cfg['origin'];
    }

    $cached = rajaongkir_cache_get('origin', 2592000);
    if ($cached && !empty($cached['destination_id'])) {
        return (int) $cached['destination_id'];
    }

    $results = rajaongkir_search_destination('Kupang', 20);
    if (empty($results)) {
        return 0;
    }

    $best = null;
    foreach ($results as $r) {
        $city = rajaongkir_norm(isset($r['city_name']) ? $r['city_name'] : '');
        if ($city === 'kota kupang' || $city === 'kupang') {
            $best = $r;
            break;
        }
    }
    if ($best === null) {
        $best = $results[0];
    }

    $id = (int) (isset($best['id']) ? $best['id'] : 0);
    if ($id > 0) {
        rajaongkir_cache_set('origin', $id, 0, null, null);
    }
    return $id;
}

/**
 * Hitung ongkos kirim POS Indonesia dari Kota Kupang ke destinasi.
 *
 * @return array|null ['cost'=>int,'etd'=>string,'service'=>string] atau null.
 */
function rajaongkir_cost($origin, $destination, $weight, $courier)
{
    $json = rajaongkir_http('POST', '/calculate/domestic-cost', [
        'origin'      => (int) $origin,
        'destination' => (int) $destination,
        'weight'      => (int) $weight,
        'courier'     => (string) $courier,
    ]);
    if ($json === null) {
        return null;
    }

    $data = isset($json['data']) ? $json['data'] : null;
    if (!is_array($data) || empty($data)) {
        return null;
    }

    // Sebagian respons mengembalikan objek tunggal, sebagian array layanan.
    if (isset($data['cost'])) {
        $data = [$data];
    }

    $best = null;
    foreach ($data as $svc) {
        if (!is_array($svc)) {
            continue;
        }
        $cost = isset($svc['cost']) ? (int) $svc['cost'] : 0;
        if ($cost <= 0) {
            continue;
        }
        if ($best === null || $cost < $best['cost']) {
            $best = [
                'cost'    => $cost,
                'etd'     => isset($svc['etd']) ? (string) $svc['etd'] : '',
                'service' => isset($svc['service']) ? (string) $svc['service'] : '',
            ];
        }
    }

    return $best;
}

/**
 * Ongkos kirim POS dari Kota Kupang ke kelurahan tujuan (berdasarkan id data_komdanas).
 *
 * @return int Biaya kirim (0 bila tidak tersedia).
 */
function rajaongkir_biaya_kirim($komdanas_id)
{
    $komdanas_id = (int) $komdanas_id;
    if ($komdanas_id <= 0) {
        return 0;
    }

    $cfg = rajaongkir_config();
    if ($cfg['api_key'] === '') {
        return 0;
    }

    // 1) Cache ongkos kirim (TTL 7 hari).
    //    cost = 0 diperlakukan sebagai negative cache berumur 1 hari agar
    //    kegagalan API tidak memicu hit berulang pada setiap request.
    $cost_key = 'cost:' . $komdanas_id;
    $cached = rajaongkir_cache_get($cost_key, 604800);
    if ($cached !== null) {
        $cached_cost = (int) $cached['cost'];
        if ($cached_cost > 0) {
            return $cached_cost;
        }
        $ts = strtotime($cached['updated_at']);
        if ($ts !== false && (time() - $ts) <= 86400) {
            return 0;
        }
    }

    // 2) Ambil data lokasi tujuan.
    $con = db_con();
    $stmt = mysqli_prepare($con, "SELECT kel, kec, kabkota, prop_name FROM data_komdanas WHERE id=? LIMIT 1");
    if ($stmt === false) {
        return 0;
    }
    mysqli_stmt_bind_param($stmt, 'i', $komdanas_id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($res);
    mysqli_stmt_close($stmt);
    if (!$row) {
        return 0;
    }

    // 3) ID destinasi asal (Kota Kupang).
    $origin = rajaongkir_origin_id();
    if ($origin <= 0) {
        error_log('RajaOngkir: ID destinasi asal (Kota Kupang) tidak dapat ditentukan.');
        return 0;
    }

    // 4) ID destinasi tujuan (cache 30 hari).
    //    destination_id = 0 menandai "sudah dicoba tapi tidak ditemukan"
    //    (negative cache) agar pencarian yang gagal tidak memanggil API berulang.
    $dest_key = 'destid:' . $komdanas_id;
    $dest_cached = rajaongkir_cache_get($dest_key, 2592000);
    if ($dest_cached !== null) {
        $dest_id = (int) $dest_cached['destination_id'];
        if ($dest_id <= 0) {
            // Sudah pernah gagal resolve; jangan hit API lagi.
            return 0;
        }
    } else {
        $dest = rajaongkir_resolve_destination($row['kel'], $row['kec'], $row['kabkota'], $row['prop_name']);
        if ($dest === null) {
            error_log('RajaOngkir: destinasi tidak ditemukan untuk komdanas id ' . $komdanas_id);
            rajaongkir_cache_set($dest_key, 0, 0, null, null);
            return 0;
        }
        $dest_id = (int) (isset($dest['id']) ? $dest['id'] : 0);
        if ($dest_id <= 0) {
            rajaongkir_cache_set($dest_key, 0, 0, null, null);
            return 0;
        }
        rajaongkir_cache_set($dest_key, $dest_id, 0, null, null);
    }

    // 5) Hitung ongkos kirim.
    $cost = rajaongkir_cost($origin, $dest_id, $cfg['weight'], $cfg['courier']);
    if ($cost === null) {
        // Simpan kegagalan sebagai negative cache (cost=0) agar tidak
        // memanggil API berulang untuk tujuan yang sama.
        rajaongkir_cache_set($cost_key, $dest_id, 0, null, null);
        return 0;
    }

    rajaongkir_cache_set($cost_key, $dest_id, $cost['cost'], $cost['etd'], $cost['service']);
    return (int) $cost['cost'];
}
