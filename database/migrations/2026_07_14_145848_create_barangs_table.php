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

        $table->foreignId('kategori_barang_id')
            ->constrained('kategori_barangs')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        $table->foreignId('supplier_id')
            ->constrained('suppliers')
            ->cascadeOnUpdate()
            ->restrictOnDelete();

        $table->string('kode_barang', 30)->unique();

        $table->string('nama_barang', 150);

        $table->integer('stok')->default(0);

        $table->decimal('harga_beli', 15, 2);

        $table->decimal('harga_jual', 15, 2);

        $table->string('satuan', 30);

        $table->string('gambar')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('kategori_barangs');
}
};
