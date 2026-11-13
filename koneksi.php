<?php
// DATABASE APLIKASI HIPA
//
// KEAMANAN: Kredensial tidak lagi di-hardcode di file ini.
// Simpan kredensial pada file konfigurasi terpisah (idealnya di luar webroot)
// dengan format berikut di file "config.php":
//
//   <?php
//   return [
//       'servername' => 'localhost',
//       'database'   => 'skum',
//       'username'   => 'hipa_user',
//       'password'   => 'password_kuat_anda',
//   ];
//
// Jika config.php tidak ditemukan, aplikasi akan menghentikan eksekusi
// daripada memakai kredensial default yang tidak aman.
//
// Migrasi cepat (lokal): salin config.sample.php menjadi config.php dan isi.

$__config_file = __DIR__ . '/config.php';
$__config_src  = 'config.php';

if (is_file($__config_file)) {
    $__config = require $__config_file;
    if (!is_array($__config)) {
        error_log('HIPA: config.php ada tetapi tidak mengembalikan array.');
        http_response_code(500);
        die('Konfigurasi database tidak valid.');
    }
    $servername = $__config['servername'] ?? 'localhost';
    $database   = $__config['database']   ?? '';
    $username   = $__config['username']   ?? '';
    $password   = $__config['password']   ?? '';
} else {
    // Fallback untuk lingkungan pengembangan lokal XAMPP.
    // PENTING: hapus/ganti saat produksi dengan file config.php.
    $__config_src = 'environment variable';
    $servername = getenv('HIPA_DB_HOST') ?: 'localhost';
    $database   = getenv('HIPA_DB_NAME') ?: 'skum';
    $username   = getenv('HIPA_DB_USER') ?: 'root';
    $password   = getenv('HIPA_DB_PASS') !== false ? getenv('HIPA_DB_PASS') : '';

    // Di produksi, config.php wajib ada. Catat peringatan agar penyebab
    // kegagalan koneksi (mis. file tidak ter-upload) mudah ditemukan.
    error_log('HIPA: config.php TIDAK ditemukan di ' . __DIR__ . '; memakai fallback environment variable (user=' . $username . ').');
}

// Jangan tampilkan error database ke pengguna; cukup catat ke log.
mysqli_report(MYSQLI_REPORT_OFF);

$con = @mysqli_connect($servername, $username, $password, $database);

if (!$con) {
    // Log detail agar penyebab bisa dilacak dari error log server.
    error_log(sprintf(
        'HIPA: koneksi database gagal (errno %d: %s) | sumber konfigurasi=%s | host=%s | db=%s | user=%s | config.php ada=%s',
        mysqli_connect_errno(),
        mysqli_connect_error(),
        $__config_src,
        $servername,
        $database,
        $username,
        is_file($__config_file) ? 'ya' : 'TIDAK'
    ));
    http_response_code(500);
    die('Terjadi kesalahan pada server. Silakan coba beberapa saat lagi.');
}

// Gunakan charset utf8mb4 agar aman terhadap encoding aneh.
mysqli_set_charset($con, 'utf8mb4');

// Kode Satker
$kode_satker = "W23-A1";

// Logo Satker Update di folder "img/logo.png"
