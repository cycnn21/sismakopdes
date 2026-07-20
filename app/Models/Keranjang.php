<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Keranjang extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',
        'barang_id',
        'jumlah',
        'harga',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relasi User
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi Barang
    |--------------------------------------------------------------------------
    */

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Subtotal
    |--------------------------------------------------------------------------
    */

    public function getSubtotalAttribute()
    {
        return $this->jumlah * $this->harga;
    }
}