<?php
// Set true saat sinkronisasi manual/terjadwal, false untuk produksi publik.
// PENTING: script ini menghapus & mengisi ulang tabel data_komdanas,
// jadi sebaiknya hanya dijalankan oleh admin / scheduler, bukan akses publik.
include('koneksi.php');

// Tampilkan error saat debugging (matikan di produksi).
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * Hilangkan karakter kutip tunggal (') dan kutip ganda (") dari data,
 * serta rapikan spasi berlebih. Dipakai untuk data teks dari Komdanas
 * agar karakter tersebut tidak merusak data/query.
 */
function bersihkan($teks)
{
    if ($teks === null) {
        return '';
    }
    $teks = (string) $teks;
    // Hapus tanda kutip tunggal dan ganda.
    $teks = str_replace(array("'", '"'), '', $teks);
    // Rapikan spasi ganda / spasi di ujung.
    $teks = trim(preg_replace('/\s+/u', ' ', $teks));
    return $teks;
}

// --- Baca data dari file lokal radius.json (bukan lagi dari Komdanas) ---
$file_json = __DIR__ . '/radius.json';

if (!is_file($file_json)) {
    die("Gagal: file radius.json tidak ditemukan di " . $file_json . ".");
}

$json = @file_get_contents($file_json);

if ($json === false || $json === '') {
    die("Gagal membaca data dari file radius.json.");
}

$d = json_decode($json, true);

// --- Validasi hasil sebelum menghapus data lama ---
if (!is_array($d) || count($d) === 0) {
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
    die("Gagal menyiapkan query INSERT: " . mysqli_error($con));
}

if (!mysqli_query($con, "DELETE FROM data_komdanas")) {
    mysqli_rollback($con);
    die("Gagal menghapus data lama: " . mysqli_error($con));
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

    // Bersihkan karakter ' dan " dari data teks agar tidak merusak data/query.
    $satker_name  = bersihkan($r['satker_name']);
    $satker_code  = (int) $r['satker_code'];
    $prop         = (int) $r['prop'];
    $prop_name    = bersihkan($r['prop_name']);
    $kabkota      = bersihkan($r['kabkota']);
    $kec          = bersihkan($r['kec']);
    $kel          = bersihkan($r['kel']);
    $nomor_radius = (int) $r['nomor_radius'];
    $nilai        = (int) $r['nilai'];

    mysqli_stmt_bind_param(
        $stmt,
        "siississi",
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
    die("Gagal: tidak ada baris yang berhasil dimasukkan. Perubahan dibatalkan.");
}

mysqli_commit($con);

echo "Selesai. Berhasil: {$berhasil} baris. Gagal: {$gagal} baris. Sumber: radius.json.";
