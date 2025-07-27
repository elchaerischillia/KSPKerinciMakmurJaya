<?php

namespace App\Http\Controllers\Backsite;

use Carbon\Carbon;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{

    // laporan pinjaman
    public function showLaporanPeminjaman()
    {
        $laporan_peminjaman = Pinjaman::with('anggota', 'kategori_angsuran', 'kategori_pinjaman', 'user')->paginate(10);;

        return view('pages.laporan-peminjaman.index', compact('laporan_peminjaman'));
    }

    public function cetakLaporanPeminjaman(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $laporan_peminjaman = Pinjaman::with('anggota', 'kategori_angsuran', 'kategori_pinjaman', 'user')
            ->whereBetween('tanggal_pinjam', [$startDate, $endDate])
            ->get();

        if ($laporan_peminjaman->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk bulan dan tahun yang dipilih.');
        }

        return view('pages.laporan-peminjaman.cetak', compact('data', 'startDate', 'endDate'));
    }

    public function cetakLaporanPeminjamanPdf(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $laporan_peminjaman = Pinjaman::with(['user', 'anggota', 'kategori_pinjaman', 'kategori_angsuran'])
            ->whereBetween('tanggal_pinjam', [$startDate, $endDate])
           ->paginate(10);

        if ($laporan_peminjaman->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk bulan dan tahun yang dipilih.');
        }

        if ($request->input('action') == 'print') {
            $html = view('pages.laporan-peminjaman.cetak', compact('laporan_peminjaman', 'year', 'month'))->render();
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML($html);
            $filename = "Laporan_Peminjaman_{$month}_{$year}.pdf";
            return $mpdf->Output($filename, 'D');
        }

        return view('pages.laporan-peminjaman.index', compact('laporan_peminjaman'));
    }


    // function laporan simpanan
    public function showLaporanSimpanan()
    {
        $laporan_simpanan = Simpanan::with('user', 'anggota', 'kategori_simpan')->paginate(10);

        return view('pages.laporan-simpan.index', compact('laporan_simpanan'));
    }
    public function cetakLaporanSimpanan(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $laporan_simpanan = Simpanan::with('anggota', 'kategori_simpan', 'user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        if ($laporan_simpanan->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk bulan dan tahun yang dipilih.');
        }

        return view('pages.laporan-peminjaman.cetak', compact('laporan_simpanan', 'startDate', 'endDate'));
    }
    public function cetakLaporanSimpananPdf(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $laporan_simpanan = Simpanan::with(['anggota', 'kategori_simpan', 'user'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->paginate(10);

        if ($laporan_simpanan->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk bulan dan tahun yang dipilih.');
        }

        if ($request->input('action') == 'print') {
            $html = view('pages.laporan-simpan.cetak', compact('laporan_simpanan', 'year', 'month'))->render();

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);

            $filename = "Laporan_Simpanan_{$month}_{$year}.pdf";

            return $mpdf->Output($filename, 'D');
        }

        return view('pages.laporan-simpan.index', compact('laporan_simpanan'));

    }





    // function laporan angsuran
    public function showLaporanAngsuran()
    {
        $laporan_angsuran = Angsuran::with('pinjaman')->paginate(10);

        return view('pages.laporan-angsuran.index', compact('laporan_angsuran'));
    }

    public function cetakLaporanAngsuran(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $laporan_angsuran = Angsuran::with('pinjaman')
            ->whereBetween('tgl_jatuh_tempo', [$startDate, $endDate])
            ->get();

        if ($laporan_angsuran->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk bulan dan tahun yang dipilih.');
        }

        return view('pages.laporan-angsuran.cetak', compact('laporan_angsuran', 'startDate', 'endDate'));
    }

    public function cetakLaporanAngsuranPdf(Request $request)
    {
        $request->validate([
            'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
            'month' => 'required|integer|min:1|max:12',
        ]);

        $year = $request->year;
        $month = $request->month;

        $startDate = Carbon::create($year, $month, 1)->startOfMonth();
        $endDate = Carbon::create($year, $month, 1)->endOfMonth();

        $laporan_angsuran = Angsuran::with(['pinjaman'])
            ->whereBetween('tgl_jatuh_tempo', [$startDate, $endDate])
            ->paginate(5);

        if ($laporan_angsuran->isEmpty()) {
            return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk bulan dan tahun yang dipilih.');
        }

        if ($request->input('action') == 'print') {
            $html = view('pages.laporan-angsuran.cetak', compact('laporan_angsuran', 'year', 'month'))->render();

            $mpdf = new \Mpdf\Mpdf();

            $mpdf->WriteHTML($html);

            $filename = "Laporan_Angsuran_{$month}_{$year}.pdf";

            return $mpdf->Output($filename, 'D');
        }

        return view('pages.laporan-angsuran.index', compact('laporan_angsuran'));

    }
}
