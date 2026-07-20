<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {

            $table->string('status')
                ->default('Menunggu');

            $table->string('nama_penerima');

            $table->string('telepon');

            $table->text('alamat');

            $table->text('catatan')
                ->nullable();

        });
    }

    public function down(): void
    {
        Schema::table('transaksis', function (Blueprint $table) {

            $table->dropColumn([
                'status',
                'nama_penerima',
                'telepon',
                'alamat',
                'catatan'
            ]);

        });
    }
};
