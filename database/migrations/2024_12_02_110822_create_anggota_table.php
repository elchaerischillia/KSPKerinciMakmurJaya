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
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('no_rek')->unique();
            $table->string('nama_bank');
            $table->string('nama_lengkap');
            $table->string('tmpt_lahir');
            $table->date('tgl_lahir');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->string('no_hp')->unique();
            $table->longText('alamat');
            $table->longText('foto')->nullable();
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
        Schema::dropIfExists('anggota');
    }
};
