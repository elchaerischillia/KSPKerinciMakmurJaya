<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAngsuran extends Model
{
    // use HasFactory;

    protected $table = 'kategori_angsuran';


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kategori_pinjaman_id',
        'bulan',//integer 1 - 12
        'nominal',
        'total_bayar',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kategori_pinjaman()
    {
        return $this->belongsTo(KategoriPinjaman::class, 'kategori_pinjaman_id', 'id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'kategori_angsuran_id');
    }


}
