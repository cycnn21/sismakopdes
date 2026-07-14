<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Barang;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 20; $i++) {

            Barang::create([

                'kategori_barang_id' => rand(1,8),

                'supplier_id' => rand(1,8),

                'kode_barang' => 'BRG'.str_pad($i,4,'0',STR_PAD_LEFT),

                'nama_barang' => 'Barang '.$i,

                'stok' => rand(10,100),

                'harga_beli' => rand(10000,50000),

                'harga_jual' => rand(60000,120000),

                'satuan' => 'Pcs',

                'gambar' => null,

            ]);

        }
    }
}