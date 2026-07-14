<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $fillable = [
        'kategori_barang_id',
        'supplier_id',
        'kode_barang',
        'nama_barang',
        'stok',
        'harga_beli',
        'harga_jual',
        'satuan',
        'gambar'
    ];

    public function kategoriBarang()
    {
        return $this->belongsTo(KategoriBarang::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function stokMasuks()
    {
        return $this->hasMany(StokMasuk::class);
    }

    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }
}