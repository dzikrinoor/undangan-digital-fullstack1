<?php

/**
 * Payment Configuration
 * 
 * Konfigurasi metode pembayaran untuk undangan digital
 * Berisi informasi nomor rekening bank dan dompet digital
 */

return [
    /**
     * Bank Transfer / Rekening Bank
     * Mendukung transfer dari berbagai bank
     */
    'bank_accounts' => [
        // Contoh format:
        // [
        //     'bank_name' => 'Bank Central Asia',
        //     'bank_code' => 'BCA',
        //     'account_number' => '1234567890',
        //     'account_holder' => 'Nama Penerima',
        //     'is_active' => true,
        // ],
    ],

    /**
     * Digital Wallets / Dompet Digital
     * Mendukung berbagai platform dompet digital
     */
    'digital_wallets' => [
        // Contoh format:
        // [
        //     'wallet_type' => 'gopay', // gopay, dana, ovo, linkaja, etc
        //     'phone_number' => '62812345678',
        //     'wallet_name' => 'Nama Pemilik',
        //     'display_name' => 'GoPay (+62812345678)',
        //     'is_active' => true,
        // ],
    ],

    /**
     * QRIS (Quick Response Code Indonesian Standard)
     * Kode QR untuk pembayaran digital
     */
    'qris' => [
        'is_active' => false,
        'qris_url' => null, // URL ke file gambar QRIS
        'display_text' => 'Scan QRIS untuk mengirim hadiah',
    ],

    /**
     * Cryptocurrency (Opsional)
     * Support untuk pembayaran menggunakan cryptocurrency
     */
    'crypto_wallets' => [
        'is_enabled' => false,
        'wallets' => [
            // [
            //     'currency' => 'BTC',
            //     'address' => '1A1z7agoat...',
            //     'display_name' => 'Bitcoin',
            // ],
        ],
    ],

    /**
     * Instruksi Pembayaran
     * Teks instruksi yang ditampilkan untuk setiap metode
     */
    'instructions' => [
        'bank_transfer' => 'Silakan transfer ke rekening yang tersedia dengan jumlah sesuai keinginan Anda.',
        'digital_wallet' => 'Buka aplikasi dompet digital Anda dan transfer ke nomor yang tertera.',
        'qris' => 'Scan QR code di bawah dengan aplikasi mobile banking atau dompet digital Anda.',
        'crypto' => 'Transfer ke alamat dompet cryptocurrency yang tersedia.',
    ],

    /**
     * Konfigurasi Default
     * Pengaturan umum untuk pembayaran
     */
    'default' => [
        'currency' => 'IDR',
        'show_minimum_gift' => true,
        'minimum_gift_amount' => 10000,
        'show_suggested_amounts' => true,
        'suggested_amounts' => [25000, 50000, 100000, 250000, 500000],
    ],

    /**
     * Kategori Jenis Pembayaran
     * Untuk pengorganisiran metode pembayaran
     */
    'payment_methods' => [
        'bank' => [
            'label' => 'Transfer Bank',
            'icon' => 'bank',
            'enabled' => true,
        ],
        'wallet' => [
            'label' => 'Dompet Digital',
            'icon' => 'wallet',
            'enabled' => true,
        ],
        'qris' => [
            'label' => 'QRIS',
            'icon' => 'qr-code',
            'enabled' => false,
        ],
        'crypto' => [
            'label' => 'Cryptocurrency',
            'icon' => 'bitcoin',
            'enabled' => false,
        ],
    ],
];