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
        Schema::create('transaksi_simpan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('simpanan_id')->nullable()->index('fk_transaksi_simpan_to_simpanan');
            $table->foreignId('user_id')->nullable()->index('fk_transaksi_simpan_to_users');
            $table->string('kode_transaksi')->unique();
            $table->enum('metode_pembayaran', ['Cash', 'Transfer']);
            $table->enum('jenis_transaksi', ['Simpan', 'Tarik']);
            $table->integer('nominal');
            $table->longText('bukti_trans')->nullable();
            $table->longText('keterangan')->nullable();
            $table->boolean('status')->default(true);
            $table->integer('saldo_akhir');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_simpan');
    }
};
