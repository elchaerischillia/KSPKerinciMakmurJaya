<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;
      protected $table = 'galeris';

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'judul',
        'foto',
        'deskripsi',

    ];
}
