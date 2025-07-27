<?php

namespace App\Http\Controllers\Backsite;

use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TransaksiSimpan;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $anggota = Anggota::count();
        $peminjaman = Pinjaman::count();
        $simpanan = Simpanan::count();
        $angsuran = Pembayaran::sum('nominal');
        $total_simpanan = Simpanan::sum('saldo_simpanan');
        $angsuran_terlambat = Angsuran::where('status', 'Terlambat')->count();

        // Data untuk grafik pinjaman


        return view('pages.dashboard.index', compact('anggota', 'peminjaman', 'simpanan', 'angsuran','total_simpanan', 'angsuran_terlambat'));

        }
}
