<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_lengkap',
        'username',
        'password',
        'role',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function simpanan()
    {
        return $this->hasMany(Simpanan::class, 'user_id');
    }

    public function detail_user()
    {
        return $this->hasOne(DetailUser::class, 'user_id');
    }

    public function transaksi_simpan()
    {
        return $this->hasMany(TransaksiSimpan::class, 'user_id');
    }

    public function pinjaman()
    {
        return $this->hasMany(Pinjaman::class, 'user_id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'user_id');
    }
}
