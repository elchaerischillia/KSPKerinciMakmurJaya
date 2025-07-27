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
        Schema::table('transaksi_simpan', function (Blueprint $table) {
            $table->foreign('simpanan_id', 'fk_transaksi_simpan_to_simpanan')->references('id')->on('simpanan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_transaksi_simpan_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaksi_simpan', function (Blueprint $table) {
            $table->dropForeign('fk_transaksi_simpan_to_simpanan');
            $table->dropForeign('fk_transaksi_simpan_to_users');
        });
    }
};
