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
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->foreign('anggota_id', 'fk_pinjaman_to_anggota')->references('id')->on('anggota')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('kategori_pinjaman_id', 'fk_pinjaman_to_kategori_pinjaman')->references('id')->on('kategori_pinjaman')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('kategori_angsuran_id', 'fk_pinjaman_to_kategori_angsuran')->references('id')->on('kategori_angsuran')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_pinjaman_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pinjaman', function (Blueprint $table) {
            $table->dropForeign('fk_pinjaman_to_anggota');
            $table->dropForeign('fk_pinjaman_to_kategori_pinjaman');
            $table->dropForeign('fk_pinjaman_to_kategori_angsuran');
            $table->dropForeign('fk_pinjaman_to_users');
        });
    }
};
