<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal (Mass Assignable).
     * Pastikan nama kolom di sini sama persis dengan yang ada di migration.
     */
    protected $fillable = [
        'nama',
        'kehadiran',
        'ucapan'
    ];
}