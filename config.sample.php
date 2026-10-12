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
];
