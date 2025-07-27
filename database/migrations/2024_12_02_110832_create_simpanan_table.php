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
        Schema::create('simpanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->index('fk_simpanan_to_users');
            $table->foreignId('anggota_id')->nullable()->index('fk_simpanan_to_anggota');
            $table->foreignId('kategori_simpan_id')->nullable()->index('fk_simpanan_to_kategori_simpan');
            $table->integer('saldo_simpanan')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanan');
    }
};
