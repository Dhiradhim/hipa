<?php

/**
 * Script sinkronisasi data_komdanas dari file lokal radius.json.
 *
 * KEAMANAN:
 * - Script ini MENGHAPUS & MENGISI ULANG tabel data_komdanas.
 * - Hanya boleh dijalankan via CLI (scheduler) ATAU via web dengan token rahasia.
 * - Token diambil dari environment variable HIPA_SYNC_TOKEN.
 * - Error detail TIDAK ditampilkan ke pengguna (hanya dicatat ke log).
 */

// Matikan tampilan error ke output; catat ke log server.
ini_set('display_errors', 0);
error_reporting(E_ALL);

require __DIR__ . '/koneksi.php';

/**
 * Cek apakah script berjalan dari CLI.
 */
function is_cli()
{
    return (PHP_SAPI === 'cli');
}

/**
 * Ambil token sinkronisasi dari config.php ('sync_token') terlebih dahulu,
 * lalu fallback ke environment variable HIPA_SYNC_TOKEN.
 */
function get_sync_token()
{
    static $token = null;
    if ($token !== null) {
        return $token;
    }

    $token = '';
    $config_file = __DIR__ . '/config.php';
    if (is_file($config_file)) {
        $config = require $config_file;
        if (is_array($config) && !empty($config['sync_token'])) {
            $token = (string) $config['sync_token'];
        }
    }

    if ($token === '') {
        $env = getenv('HIPA_SYNC_TOKEN');
        if ($env !== false) {
            $token = (string) $env;
        }
    }

    return $token;
}

/**
 * Jalankan hanya jika CLI, atau web request dengan token valid via header/query.
 * Token dibandingkan memakai hash_equals() agar tahan timing attack.
 */
function authorize_sync()
{
    $expected = get_sync_token();

    if ($expected === false || $expected === '') {
        // Token belum dikonfigurasi -> tolak akses web (paksa CLI).
        if (!is_cli()) {
            http_response_code(403);
            die('Akses ditolak: script sinkronisasi hanya dapat dijalankan via CLI.');
        }
        return;
    }

    if (is_cli()) {
        return;
    }

    // Ambil token dari header Authorization: Bearer <token> atau ?token=
    $provided = '';
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $provided = $_SERVER['HTTP_AUTHORIZATION'];
    } elseif (function_exists('apache_request_headers')) {
        $headers = apache_request_headers();
        if (isset($headers['Authorization'])) {
            $provided = $headers['Authorization'];
        }
    }
    $provided = preg_replace('/^Bearer\s+/i', '', $provided);
    if ($provided === '' && isset($_GET['token'])) {
        $provided = (string) $_GET['token'];
    }

    if (!is_string($provided) || !hash_equals($expected, $provided)) {
        http_response_code(403);
        die('Akses ditolak: token tidak valid.');
    }
}

authorize_sync();

/**
 * Hilangkan karakter kutip tunggal (') dan kutip ganda (") dari data,
 * serta rapikan spasi berlebih. Data insidental dari sumber eksternal.
 */
function bersihkan($teks)
{
    if ($teks === null) {
        return '';
    }
    $teks = (string) $teks;
    $teks = str_replace(array("'", '"'), '', $teks);
    $teks = trim(preg_replace('/\s+/u', ' ', $teks));
    return $teks;
}

// --- Baca data dari file lokal radius.json ---
$file_json = __DIR__ . '/radius.json';

if (!is_file($file_json)) {
    error_log('Sinkronisasi gagal: file radius.json tidak ditemukan.');
    die("Gagal: file radius.json tidak ditemukan.");
}

$json = @file_get_contents($file_json);

if ($json === false || $json === '') {
    error_log('Sinkronisasi gagal: gagal membaca radius.json.');
    die("Gagal membaca data dari file radius.json.");
}

$d = json_decode($json, true);

// --- Validasi hasil sebelum menghapus data lama ---
if (!is_array($d) || count($d) === 0) {
    error_log('Sinkronisasi gagal: isi radius.json bukan JSON valid atau kosong.');
    die("Gagal: isi radius.json bukan JSON valid atau kosong. Data lama TIDAK dihapus.");
}

// --- Proses: hapus & isi ulang dalam satu transaksi agar aman ---
mysqli_begin_transaction($con);

$stmt = mysqli_prepare(
    $con,
    "INSERT INTO data_komdanas
        (satker_name, satker_code, prop, prop_name, kabkota, kec, kel, nomor_radius, nilai)
     VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
);

if ($stmt === false) {
    mysqli_rollback($con);
    error_log('Sinkronisasi gagal menyiapkan query INSERT: ' . mysqli_error($con));
    die("Gagal menyiapkan query INSERT.");
}

if (!mysqli_query($con, "DELETE FROM data_komdanas")) {
    mysqli_rollback($con);
    error_log('Sinkronisasi gagal menghapus data lama: ' . mysqli_error($con));
    die("Gagal menghapus data lama.");
}

$berhasil = 0;
$gagal    = 0;

foreach ($d as $r) {
    // Lewati baris yang tidak lengkap.
    if (!isset(
        $r['satker_name'],
        $r['satker_code'],
        $r['prop'],
        $r['prop_name'],
        $r['kabkota'],
        $r['kec'],
        $r['kel'],
        $r['nomor_radius'],
        $r['nilai']
    )) {
        $gagal++;
        continue;
    }

    $satker_name  = bersihkan($r['satker_name']);
    $satker_code  = (string) $r['satker_code'];
    $prop         = (string) $r['prop'];
    $prop_name    = bersihkan($r['prop_name']);
    $kabkota      = bersihkan($r['kabkota']);
    $kec          = bersihkan($r['kec']);
    $kel          = bersihkan($r['kel']);
    $nomor_radius = (int) $r['nomor_radius'];
    $nilai        = (int) $r['nilai'];

    mysqli_stmt_bind_param(
        $stmt,
        "sssssssii",
        $satker_name,
        $satker_code,
        $prop,
        $prop_name,
        $kabkota,
        $kec,
        $kel,
        $nomor_radius,
        $nilai
    );

    if (mysqli_stmt_execute($stmt)) {
        $berhasil++;
    } else {
        $gagal++;
    }
}

mysqli_stmt_close($stmt);

if ($berhasil === 0) {
    // Tidak ada satu pun baris masuk -> batalkan agar data lama tidak hilang.
    mysqli_rollback($con);
    error_log('Sinkronisasi dibatalkan: tidak ada baris yang berhasil dimasukkan.');
    die("Gagal: tidak ada baris yang berhasil dimasukkan. Perubahan dibatalkan.");
}

mysqli_commit($con);

echo "Selesai. Berhasil: {$berhasil} baris. Gagal: {$gagal} baris. Sumber: radius.json.";
