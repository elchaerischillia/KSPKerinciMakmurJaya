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
        Schema::create('kategori_angsuran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_pinjaman_id')->nullable()->index('fk_angsuran_to_kategori_pinjaman');
            $table->integer('bulan')->default(1);
            $table->integer('nominal')->default(0);
            $table->integer('total_bayar')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('angsuran');
    }
};
