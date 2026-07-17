<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Barang;
use App\Models\BarangMasuk;

class Supplier extends Model
{
    protected $fillable = [
        'nama_supplier',
        'alamat',
        'telepon',
        'email',
        'status',
    ];

    protected $attributes = [
        'status' => 'aktif',
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

    public function barangMasuks()
{
    return $this->hasMany(
        BarangMasuk::class
    );
}
}