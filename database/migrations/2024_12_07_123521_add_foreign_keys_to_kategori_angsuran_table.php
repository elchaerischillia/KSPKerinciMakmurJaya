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
        Schema::table('kategori_angsuran', function (Blueprint $table) {
            $table->foreign('kategori_pinjaman_id', 'fk_kategori_angsuran_to_kategori_pinjaman')->references('id')->on('kategori_pinjaman')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('angsuran', function (Blueprint $table) {
            $table->dropForeign('fk_kategori_angsuran_to_kategori_pinjaman');
        });
    }
};
