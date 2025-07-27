<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tentang extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database.
     *
     * (Opsional. Laravel default pakai plural nama model, yaitu `tentangs`.)
     */
    protected $table = 'tentangs';

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'judul',
        'isi',
        'jenis',
    ];
}
