<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
     // Nama tabel di database
    protected $table = 'faqs';

    // Kolom yang boleh diisi (mass-assignment)
    protected $fillable = [
        'pertanyaan',
        'jawaban',
        'urutan',
        'status',
    ];
}
