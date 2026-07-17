<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\BarangMasuk;
use App\Models\Keranjang;

// Tambahkan import ini
use App\Models\Transaksi;
use App\Models\ActivityLog;

#[Fillable([
    'name',
    'email',
    'password',
    'role'
])]

#[Hidden([
    'password',
    'remember_token'
])]

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke transaksi
     */
    public function transaksis()
    {
        return $this->hasMany(
            Transaksi::class
        );
    }

    /**
     * Relasi ke activity log
     */
    public function activityLogs()
    {
        return $this->hasMany(
            ActivityLog::class
        );
    }

    /**
     * Relasi barang masuk
     */
    public function barangMasuks()
    {
        return $this->hasMany(
            BarangMasuk::class
        );
    }

    /**
     * Relasi keranjang
     */
    public function keranjangs()
    {
        return $this->hasMany(
            Keranjang::class
        );
    }
}