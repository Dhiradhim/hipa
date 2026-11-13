<?php
// Salin file ini menjadi "config.php" lalu isi dengan kredensial asli.
// JANGAN commit config.php yang berisi kredensial asli ke repository publik.
// Idealnya letakkan config.php di luar webroot.
return [
    'servername' => 'localhost',
    'database'   => 'skum',
    'username'   => 'hipa_user',
    'password'   => 'ganti_dengan_password_kuat',

    // Token rahasia untuk menjalankan tarik_data_komdanas.php via web.
    // Buat token acak, contoh: php -r "echo bin2hex(random_bytes(32));"
    // Kosongkan untuk memaksa sinkronisasi hanya via CLI.
    'sync_token' => 'ganti_dengan_token_acak_panjang',

    // ===== Integrasi RajaOngkir (Komerce) =====
    // Dapatkan API key di https://rajaongkir.com (dashboard Komerce).
    // Kosongkan untuk menonaktifkan perhitungan ongkos kirim POS
    // (aplikasi akan memakai nilai radius statis sebagai fallback).
    'rajaongkir_api_key'  => 'ganti_dengan_api_key_rajaongkir',
    'rajaongkir_base_url' => 'https://rajaongkir.komerce.id/api/v1',
    // ID destinasi asal (Kota Kupang). Biarkan 0 agar dideteksi otomatis.
    'rajaongkir_origin'   => 0,
    // Berat paket (gram) yang dipakai untuk menghitung ongkos kirim.
    'rajaongkir_weight'   => 1000,
    // Kurir yang dipakai (pos = POS Indonesia).
    'rajaongkir_courier'  => 'pos',
];
