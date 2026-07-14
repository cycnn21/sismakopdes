<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriBarang extends Model
{
    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}