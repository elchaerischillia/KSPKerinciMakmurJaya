<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransaksiSimpan extends Model
{

    use SoftDeletes;

    protected $table = 'transaksi_simpan';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $guarded = ['kode_transaksi'];

    protected $fillable = [
        'simpanan_id',
        'user_id',
        'kode_transaksi',
        'jenis_transaksi',
        'metode_pembayaran',
        'nominal',
        'bukti_trans',
        'saldo_akhir',
        'keterangan',
        'status'
    ];

    public function simpanan()
    {
        return $this->belongsTo(Simpanan::class, 'simpanan_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
