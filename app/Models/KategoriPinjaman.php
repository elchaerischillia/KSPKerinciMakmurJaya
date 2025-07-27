<?php

namespace App\Models;

use App\Models\KategoriAngsuran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriPinjaman extends Model
{
    use SoftDeletes;

    protected $table = 'kategori_pinjaman';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nama_kategori',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function angsuran()
    {
        return $this->hasMany(KategoriAngsuran::class, 'kategori_pinjaman_id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'kategori_pinjaman_id');
    }
}
