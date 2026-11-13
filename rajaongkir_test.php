<?php

/**
 * Skrip diagnostik integrasi RajaOngkir.
 *
 * Jalankan via CLI:
 *   php rajaongkir_test.php
 *   php rajaongkir_test.php 70765        (uji dengan id data_komdanas tertentu)
 *
 * Skrip ini TIDAK boleh diakses via web (hanya CLI) agar tidak membocorkan
 * informasi konfigurasi.
 */

if (PHP_SAPI !== 'cli') {
    http_response_code(403);
    die('Skrip ini hanya dapat dijalankan via CLI.');
}

require __DIR__ . '/koneksi.php';
require __DIR__ . '/fungsi.php';
require __DIR__ . '/rajaongkir.php';

function out($label, $value)
{
    echo str_pad($label, 28) . ': ' . $value . PHP_EOL;
}

echo "=== Diagnostik RajaOngkir ===" . PHP_EOL;

$cfg = rajaongkir_config();
out('API key terpasang', rajaongkir_is_configured() ? 'ya' : 'TIDAK (isi config.php)');
out('Base URL', $cfg['base_url']);
out('Kurir', $cfg['courier']);
out('Berat (gram)', $cfg['weight']);

if (!rajaongkir_is_configured()) {
    echo PHP_EOL . 'API key belum diatur. Perhitungan ongkos kirim POS dinonaktifkan.' . PHP_EOL;
    exit(1);
}

if (!function_exists('curl_init')) {
    echo PHP_EOL . 'Ekstensi cURL tidak tersedia. Aktifkan extension=curl pada php.ini.' . PHP_EOL;
    exit(1);
}

echo PHP_EOL . '--- Destinasi asal (Kota Kupang) ---' . PHP_EOL;
$origin = rajaongkir_origin_id();
out('ID destinasi asal', $origin > 0 ? $origin : 'TIDAK DITEMUKAN');
if ($origin <= 0) {
    exit(1);
}

$komdanas_id = isset($argv[1]) ? (int) $argv[1] : 0;

if ($komdanas_id <= 0) {
    // Ambil satu contoh kelurahan di luar Kota Kupang sebagai sampel.
    $con = db_con();
    $res = mysqli_query($con, "SELECT id, kel, kec, kabkota, prop_name FROM data_komdanas WHERE kabkota <> 'Kota Kupang' LIMIT 1");
    $row = $res ? mysqli_fetch_assoc($res) : null;
    if (!$row) {
        echo 'Tidak ada data_komdanas untuk diuji.' . PHP_EOL;
        exit(1);
    }
    $komdanas_id = (int) $row['id'];
    echo PHP_EOL . '--- Sampel tujuan (id ' . $komdanas_id . ') ---' . PHP_EOL;
    out('Kelurahan', $row['kel']);
    out('Kecamatan', $row['kec']);
    out('Kab/Kota', $row['kabkota']);
    out('Provinsi', $row['prop_name']);
}

echo PHP_EOL . '--- Perhitungan ongkos kirim ---' . PHP_EOL;
rajaongkir_api_hits(true);
$biaya = rajaongkir_biaya_kirim($komdanas_id);
out('ID data_komdanas', $komdanas_id);
out('Ongkos kirim POS', $biaya > 0 ? rp($biaya) : 'TIDAK TERSEDIA');
out('Hit API (proses ini)', rajaongkir_api_hits());

echo PHP_EOL . 'Catatan: hit > 0 berarti cache belum terisi. Jalankan ulang untuk';
echo PHP_EOL . 'memastikan cache bekerja (hit harus 0 pada proses berikutnya).' . PHP_EOL;

echo PHP_EOL . 'Selesai.' . PHP_EOL;
