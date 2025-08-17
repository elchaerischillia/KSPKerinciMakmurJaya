<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $table = 'anggota';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'tmpt_lahir',
        'tgl_lahir',
        'nama_bank',
        'no_rek',
        'jk',
        'no_hp',
        'alamat',
        'foto',
        'status'
    ];

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'anggota_id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'anggota_id');
    }

     public function angsuran()
    {
        return $this->hasMany(Angsuran::class, 'anggota_id', 'id');
    }
}
