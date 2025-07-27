<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
      protected $table = 'kontaks';

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'alamat',
        'no_hp',
        'email',
        'maps',
        'jam_buka',
    ];
}
