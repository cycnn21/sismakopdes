<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Barang;
use App\Models\User;

class BarangKeluar extends Model
{
    protected $fillable = [

        'kode_keluar',
        'barang_id',
        'jumlah',
        'tanggal_keluar',
        'user_id',
        'keterangan',

    ];



    /**
     * Relasi ke Barang
     */
    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'barang_id'
        );
    }



    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

}