<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Barang;

class KategoriBarang extends Model
{
    use HasFactory;

    protected $table = 'kategori_barangs';

    protected $fillable = [
        'nama_kategori',
        'keterangan'
    ];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}
