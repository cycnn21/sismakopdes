<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barangs', function (Blueprint $table) {

            $table->id();

            // Relasi kategori
            $table->foreignId('kategori_barang_id')
                ->constrained('kategori_barangs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            // Relasi supplier
            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();


            $table->string('kode_barang')->unique();

            $table->string('nama_barang');

            $table->integer('stok')->default(0);

            $table->decimal('harga_beli', 12, 2);

            $table->decimal('harga_jual', 12, 2);

            $table->string('satuan',30);

            $table->string('status')->nullable();

            $table->string('gambar')->nullable();

            $table->text('deskripsi')->nullable();


            $table->timestamps();

        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangs');
    }
};