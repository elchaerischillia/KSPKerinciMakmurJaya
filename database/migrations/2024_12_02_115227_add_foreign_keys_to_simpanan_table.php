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
        Schema::table('simpanan', function (Blueprint $table) {
            $table->foreign('user_id', 'fk_simpanan_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('anggota_id', 'fk_simpanan_to_anggota')->references('id')->on('anggota')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('kategori_simpan_id', 'fk_simpanan_to_kategori_simpan')->references('id')->on('kategori_simpan')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('simpanan', function (Blueprint $table) {
            $table->dropForeign('fk_simpanan_to_users');
            $table->dropForeign('fk_simpanan_to_anggota');
            $table->dropForeign('fk_simpanan_to_kategori_simpan');
        });
    }
};
