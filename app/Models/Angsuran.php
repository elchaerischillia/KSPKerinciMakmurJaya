<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Angsuran extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $table = 'angsuran';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'pinjaman_id',
        'tgl_jatuh_tempo',
        'status',
    ];

    public function pinjaman()
    {
        return $this->belongsTo(Pinjaman::class, 'pinjaman_id','id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'angsuran_id');
    }
}
