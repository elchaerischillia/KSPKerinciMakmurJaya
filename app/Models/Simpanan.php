<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Simpanan extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $table = 'simpanan';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'anggota_id',
        'kategori_simpan_id',
        'saldo_simpanan',
        'status'
        
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }

    public function transaksi_simpan()
    {
        return $this->hasMany(TransaksiSimpan::class, 'simpanan_id');
    }


    public function kategori_simpan()
    {
        return $this->belongsTo(KategoriSimpan::class, 'kategori_simpan_id', 'id');
    }

}
