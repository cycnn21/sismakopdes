<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Barang;
use App\Models\Supplier;
use App\Models\User;


class BarangMasuk extends Model
{

    protected $fillable = [

        'kode_masuk',
        'barang_id',
        'supplier_id',
        'jumlah',
        'harga_beli',
        'tanggal_masuk',
        'user_id',
        'keterangan',

    ];
    
    protected $casts = [
    'tanggal_masuk' => 'date',
];



    /**
     * Barang yang masuk
     */
    public function barang()
    {
        return $this->belongsTo(
            Barang::class,
            'barang_id'
        );
    }



    /**
     * Supplier barang
     */
    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'supplier_id'
        );
    }



    /**
     * Admin yang input
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

}