<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBarang;

class KategoriBarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [

            'Sembako',
            'Minuman',
            'Makanan',
            'ATK',
            'Elektronik',
            'Peralatan Rumah',
            'Pertanian',
            'Lainnya'

        ];

        foreach ($kategori as $item) {

            KategoriBarang::updateOrCreate(
                ['nama_kategori' => $item],
                [
                    'keterangan' => $item
                ]
            );

        }
    }
}