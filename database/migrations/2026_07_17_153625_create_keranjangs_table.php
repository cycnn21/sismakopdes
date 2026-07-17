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
        Schema::create('keranjangs', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('barang_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->unsignedInteger('jumlah')
                ->default(1);

            $table->timestamps();

            // Satu user hanya boleh memiliki satu baris
            // untuk satu barang di keranjang
            $table->unique([
                'user_id',
                'barang_id'
            ]);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keranjangs');
    }
};