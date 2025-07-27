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
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->nullable()->index('fk_pinjaman_to_anggota');
            $table->foreignId('kategori_pinjaman_id')->nullable()->index('fk_pinjaman_to_kategori');
            $table->foreignId('kategori_angsuran_id')->nullable()->index('fk_pinjaman_to_kategori_angsuran');
            $table->foreignId('user_id')->nullable()->index('fk_pinjaman_to_users');
            $table->date('tanggal_pinjam');
            $table->string('angunan');
            $table->enum('status_pengajuan', ['Pending', 'Approved', 'Rejected', ]);
            $table->longText('bukti_angunan');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};
