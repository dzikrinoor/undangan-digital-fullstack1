<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Menentukan operasi cross-origin apa saja yang boleh dijalankan di browser.
    |
    */

    // Mengizinkan semua rute yang diawali dengan api/
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    // Mengizinkan semua metode (GET, POST, PUT, DELETE)
    'allowed_methods' => ['*'],

    // UBAH BAGIAN INI: Arahkan langsung ke URL Vite Anda
    'allowed_origins' => ['http://localhost:5173'], 

    'allowed_origins_patterns' => [],

    // Mengizinkan semua jenis header (Content-Type, Authorization, dll)
    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Ubah ke true jika nanti Anda menggunakan sistem login/sanctum
    'supports_credentials' => true, 

];