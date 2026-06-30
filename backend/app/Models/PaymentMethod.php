<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'invitation_id',
        'type', // bank, wallet, qris, crypto
        'name',
        'account_number',
        'phone_number',
        'wallet_address',
        'bank_code',
        'bank_name',
        'account_holder',
        'qris_url',
        'display_text',
        'is_active',
        'order',
        'metadata',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'metadata' => 'json',
    ];

    /**
     * Relationship ke Invitation
     */
    public function invitation()
    {
        return $this->belongsTo(Invitation::class);
    }

    /**
     * Scope untuk mengambil payment methods yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order');
    }

    /**
     * Scope untuk mengambil payment methods berdasarkan tipe
     */
    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Format nomor rekening untuk display
     */
    public function getFormattedAccountNumber()
    {
        if ($this->type === 'bank') {
            return implode('-', str_split($this->account_number, 3));
        }
        return $this->account_number;
    }

    /**
     * Format nomor telepon untuk display
     */
    public function getFormattedPhoneNumber()
    {
        $phone = $this->phone_number;
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        return $phone;
    }

    /**
     * Dapatkan informasi payment method untuk display
     */
    public function getDisplayInfo()
    {
        $info = [
            'type' => $this->type,
            'name' => $this->name,
            'is_active' => $this->is_active,
        ];

        switch ($this->type) {
            case 'bank':
                $info['bank_name'] = $this->bank_name;
                $info['account_number'] = $this->getFormattedAccountNumber();
                $info['account_holder'] = $this->account_holder;
                $info['bank_code'] = $this->bank_code;
                break;

            case 'wallet':
                $info['phone_number'] = $this->getFormattedPhoneNumber();
                $info['wallet_type'] = $this->metadata['wallet_type'] ?? null;
                break;

            case 'qris':
                $info['qris_url'] = $this->qris_url;
                $info['display_text'] = $this->display_text;
                break;

            case 'crypto':
                $info['wallet_address'] = $this->wallet_address;
                $info['currency'] = $this->metadata['currency'] ?? null;
                break;
        }

        return $info;
    }
}