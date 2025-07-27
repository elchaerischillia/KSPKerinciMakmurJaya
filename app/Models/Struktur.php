<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Struktur extends Model
{
    use HasFactory;
     protected $table = 'strukturs';

    /**
     * Kolom yang boleh diisi mass-assignment.
     */
    protected $fillable = [
        'nama',
        'foto',

    ];
}
