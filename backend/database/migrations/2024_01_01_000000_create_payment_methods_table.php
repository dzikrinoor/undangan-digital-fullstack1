<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invitation_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['bank', 'wallet', 'qris', 'crypto'])->default('bank');
            $table->string('name')->nullable(); // Nama untuk referensi (e.g., "Rekening Pribadi", "GoPay Istri")
            
            // Bank Transfer Fields
            $table->string('bank_code')->nullable(); // BCA, BRI, MANDIRI, etc
            $table->string('bank_name')->nullable(); // Nama lengkap bank
            $table->string('account_number')->nullable(); // Nomor rekening
            $table->string('account_holder')->nullable(); // Nama pemilik rekening
            
            // Digital Wallet Fields
            $table->string('phone_number')->nullable(); // Nomor telepon untuk dompet digital
            
            // Cryptocurrency Fields
            $table->string('wallet_address')->nullable(); // Alamat dompet crypto
            
            // QRIS Fields
            $table->text('qris_url')->nullable(); // URL atau path ke file QR code
            $table->string('display_text')->nullable(); // Teks untuk ditampilkan dengan QRIS
            
            // Status & Ordering
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0); // Urutan tampilan
            
            // Additional Data
            $table->json('metadata')->nullable(); // Untuk data tambahan seperti wallet_type, currency, dll
            
            // Timestamps
            $table->timestamps();
            
            // Indexes
            $table->index('invitation_id');
            $table->index('type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};