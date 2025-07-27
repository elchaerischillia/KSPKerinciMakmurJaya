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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('angsuran_id')->nullable()->index('fk_pembayaran_to_angsuran');
            $table->foreignId('user_id')->nullable()->index('fk_pembayaran_to_users');
            $table->string('kode_trans')->unique();
            $table->integer('nominal')->default(0);
            $table->enum('metode_pembayaran', ['Transfer', 'Cash']);
            $table->longText('bukti_trans')->nullable();
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('pembayaran');
    }
};
