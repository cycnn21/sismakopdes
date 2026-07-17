<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\KategoriBarang;
use App\Models\Supplier;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Keranjang;

class Barang extends Model
{
    protected $fillable = [

        'kategori_barang_id',
        'supplier_id',
        'kode_barang',
        'nama_barang',
        'stok',
        'stok_minimum',
        'harga_beli',
        'harga_jual',
        'satuan',
        'gambar',
        'deskripsi',
        'status',

    ];


    /**
     * Relasi ke kategori barang
     */
    public function kategori()
    {
        return $this->belongsTo(
            KategoriBarang::class,
            'kategori_barang_id'
        );
    }


    /**
     * Relasi ke supplier
     */
    public function supplier()
    {
        return $this->belongsTo(
            Supplier::class,
            'supplier_id'
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
     * Relasi barang keluar
     */
    public function barangKeluars()
    {
        return $this->hasMany(
            BarangKeluar::class
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


    /**
     * Otomatis menentukan status barang
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($barang) {

            if ($barang->stok <= $barang->stok_minimum) {

                $barang->status = 'nonaktif';

            } else {

                $barang->status = 'aktif';

            }

        });
    }
}