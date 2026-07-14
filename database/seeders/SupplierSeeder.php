<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 8; $i++) {

            Supplier::updateOrCreate(

                ['nama_supplier' => "Supplier {$i}"],

                [
                    'alamat' => "Alamat Supplier {$i}",
                    'telepon' => "0812345678{$i}",
                    'email' => "supplier{$i}@gmail.com",
                ]

            );

        }
    }
}