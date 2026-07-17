<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $fillable = [

        'user_id',
        'barang_id',
        'jumlah',

    ];


    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Relasi ke Barang
     */
    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}