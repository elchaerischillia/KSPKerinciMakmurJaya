<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjaman extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $table = 'pinjaman';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'anggota_id',
        'kategori_pinjaman_id',
        'kategori_angsuran_id',
        'user_id',
        'tanggal_pinjam',
        'angunan',
        'bukti_angunan',
        'status_pengajuan',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id','id');
    }

    public function kategori_pinjaman()
    {
        return $this->belongsTo(KategoriPinjaman::class, 'kategori_pinjaman_id','id');
    }

    public function kategori_angsuran()
    {
        return $this->belongsTo(KategoriAngsuran::class, 'kategori_angsuran_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'pinjaman_id');
    }
}
