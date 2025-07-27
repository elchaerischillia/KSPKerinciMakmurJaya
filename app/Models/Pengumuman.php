<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'pengumumen';

    // Kolom yang boleh diisi (mass-assignment)
    protected $fillable = [
        'judul',
        'isi',
        'status',
    ];
}
