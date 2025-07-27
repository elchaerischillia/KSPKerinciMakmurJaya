<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    // use HasFactory;
    use SoftDeletes;

    protected $table = 'pembayaran';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kode_trans',
        'angsuran_id',
        'user_id',
        'nominal',
        'metode_pembayaran',
        'bukti_trans',
        'keterangan',
        'status',
    ];

    public function angsuran()
    {
        return $this->belongsTo(Angsuran::class, 'angsuran_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
