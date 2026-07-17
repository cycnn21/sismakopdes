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
        Schema::create('barang_keluars', function (Blueprint $table) {

            $table->id();

            // Kode transaksi
            $table->string('kode_keluar')
                ->unique();

            // Relasi Barang
            $table->foreignId('barang_id')
                ->constrained('barangs')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Jumlah keluar
            $table->integer('jumlah');

            // Tanggal keluar
            $table->date('tanggal_keluar');

            // Admin yang melakukan transaksi
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Keterangan
            $table->text('keterangan')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_keluars');
    }
};