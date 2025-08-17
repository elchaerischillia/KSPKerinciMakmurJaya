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
    // ======== LAPORAN PEMINJAMAN ========
    public function showLaporanPeminjaman()
    {
        $laporan_peminjaman = Pinjaman::with('anggota', 'kategori_angsuran', 'kategori_pinjaman', 'user')
            ->paginate(10);

        return view('pages.laporan-peminjaman.index', compact('laporan_peminjaman'));
    }

    public function cetakLaporanPeminjamanPdf(Request $request)
    {
        $query = Pinjaman::with([
            'user:id,nama_lengkap',
            'anggota:id,nama_lengkap',
            'kategori_pinjaman:id,nama_kategori',
            'kategori_angsuran:id,bulan,nominal'
        ]);

        // Filter tanggal awal & akhir
        if ($request->filled(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tanggal_pinjam', [$startDate, $endDate]);
        } else {
            // Filter bulan & tahun
            $request->validate([
                'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
                'month' => 'required|integer|min:1|max:12',
            ]);

            $year = $request->year;
            $month = $request->month;
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
            $query->whereBetween('tanggal_pinjam', [$startDate, $endDate]);
        }

        if ($request->input('action') == 'print') {
            $laporan_peminjaman = $query->limit(500)->get();

            if ($laporan_peminjaman->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data peminjaman untuk periode yang dipilih.');
            }

            set_time_limit(0);

            $html = view('pages.laporan-peminjaman.cetak', compact('laporan_peminjaman'))->render();

            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_left' => 8,
                'margin_right' => 8,
            ]);
            $mpdf->WriteHTML($html);
            return $mpdf->Output("Laporan_Peminjaman.pdf", 'D');
        }

        $laporan_peminjaman = $query->paginate(10);
        return view('pages.laporan-peminjaman.index', compact('laporan_peminjaman'));
    }

    // ======== LAPORAN SIMPANAN ========
    public function showLaporanSimpanan(Request $request)
    {
        $query = Simpanan::with('user', 'anggota', 'kategori_simpan');

        if ($request->filled(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } elseif ($request->filled(['year', 'month'])) {
            $year = $request->year;
            $month = $request->month;
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $laporan_simpanan = $query->paginate(10);
        return view('pages.laporan-simpan.index', compact('laporan_simpanan'));
    }

    public function cetakLaporanSimpananPdf(Request $request)
    {
        $query = Simpanan::with([
            'anggota:id,nama_lengkap',
            'kategori_simpan:id,nama_kategori',
            'user:id,nama_lengkap'
        ]);

        if ($request->filled(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        } else {
            $request->validate([
                'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
                'month' => 'required|integer|min:1|max:12',
            ]);
            $year = $request->year;
            $month = $request->month;
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if ($request->input('action') == 'print') {
            $laporan_simpanan = $query->limit(500)->get();

            if ($laporan_simpanan->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data simpanan untuk periode yang dipilih.');
            }

            set_time_limit(0);

            $html = view('pages.laporan-simpan.cetak', compact('laporan_simpanan'))->render();

            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_left' => 8,
                'margin_right' => 8,
            ]);
            $mpdf->WriteHTML($html);
            return $mpdf->Output("Laporan_Simpanan.pdf", 'D');
        }

        $laporan_simpanan = $query->paginate(10);
        return view('pages.laporan-simpan.index', compact('laporan_simpanan'));
    }

    // ======== LAPORAN ANGSURAN ========
    public function showLaporanAngsuran(Request $request)
    {
        $query = Angsuran::with(['pinjaman.anggota', 'pinjaman.kategori_angsuran']);

        if ($request->filled(['start_date', 'end_date'])) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tgl_jatuh_tempo', [$startDate, $endDate]);
        } elseif ($request->filled(['year', 'month'])) {
            $year = $request->year;
            $month = $request->month;
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
            $query->whereBetween('tgl_jatuh_tempo', [$startDate, $endDate]);
        }

        $laporan_angsuran = $query->paginate(10);
        return view('pages.laporan-angsuran.index', compact('laporan_angsuran'));
    }

    public function cetakLaporanAngsuranPdf(Request $request)
    {
        $query = Angsuran::with([
            'pinjaman.anggota:id,nama_lengkap',
            'pinjaman.kategori_angsuran:id,bulan,nominal'
        ]);

        if ($request->filled(['start_date', 'end_date'])) {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('tgl_jatuh_tempo', [$startDate, $endDate]);
        } else {
            $request->validate([
                'year' => 'required|integer|digits:4|min:2020|max:' . now()->year,
                'month' => 'required|integer|min:1|max:12',
            ]);
            $year = $request->year;
            $month = $request->month;
            $startDate = Carbon::create($year, $month, 1)->startOfMonth();
            $endDate = Carbon::create($year, $month, 1)->endOfMonth();
            $query->whereBetween('tgl_jatuh_tempo', [$startDate, $endDate]);
        }

        if ($request->input('action') == 'print') {
            $laporan_angsuran = $query->limit(500)->get();

            if ($laporan_angsuran->isEmpty()) {
                return redirect()->back()->with('error', 'Tidak ada data angsuran untuk periode yang dipilih.');
            }

            set_time_limit(0);

            $html = view('pages.laporan-angsuran.cetak', compact('laporan_angsuran'))->render();

            $mpdf = new \Mpdf\Mpdf([
                'format' => 'A4',
                'margin_top' => 10,
                'margin_bottom' => 10,
                'margin_left' => 8,
                'margin_right' => 8,
            ]);
            $mpdf->WriteHTML($html);
            return $mpdf->Output("Laporan_Angsuran.pdf", 'D');
        }

        $laporan_angsuran = $query->paginate(10);
        return view('pages.laporan-angsuran.index', compact('laporan_angsuran'));
    }
    

}

