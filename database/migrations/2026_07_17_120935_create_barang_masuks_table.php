<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('barang_masuks', function (Blueprint $table) {


            $table->id();


            // kode transaksi
            $table->string('kode_masuk')
                ->unique();


            // relasi barang
            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();



            // relasi supplier
            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();



            // jumlah barang masuk
            $table->integer('jumlah');


            // harga beli saat transaksi
            $table->decimal(
                'harga_beli',
                12,
                2
            );


            // tanggal masuk
            $table->date('tanggal_masuk');


            // admin yang input
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();



            $table->text('keterangan')
                ->nullable();


            $table->timestamps();

        });
    }



    public function down(): void
    {
        Schema::dropIfExists('barang_masuks');
    }

};