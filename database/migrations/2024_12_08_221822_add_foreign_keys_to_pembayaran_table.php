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
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->foreign('angsuran_id', 'fk_pembayaran_to_angsuran')->references('id')->on('angsuran')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('user_id', 'fk_pembayaran_to_users')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropForeign('fk_pembayaran_to_angsuran');
            $table->dropForeign('fk_pembayaran_to_users');
        });
    }
};
