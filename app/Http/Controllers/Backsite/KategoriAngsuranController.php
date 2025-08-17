<?php

namespace App\Http\Controllers\Backsite;

use App\Models\KategoriAngsuran;
use Illuminate\Http\Request;
use App\Models\KategoriPinjaman;
use App\Http\Controllers\Controller;

class KategoriAngsuranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $angsuran = KategoriAngsuran::with('kategori_pinjaman')->get();
        return view('pages.kategori-angsuran.index', compact('angsuran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_pinjaman = KategoriPinjaman::all();
        return view('pages.kategori-angsuran.create', compact('kategori_pinjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
 public function store(Request $request)
{
    $request->validate([
        'kategori_pinjaman_id' => 'required|integer|exists:kategori_pinjaman,id',
        'bulan' => 'required|integer|min:1',
    ]);

    $kategori = KategoriPinjaman::findOrFail($request->kategori_pinjaman_id);
    $jumlah = $kategori->jumlah_pinjaman;

    // Hitung bunga flat 3%
    $bunga = $jumlah * 0.03 * $request->bulan;
    $total_bayar = $jumlah + $bunga;
    $nominal = ceil($total_bayar / $request->bulan);

    KategoriAngsuran::create([
        'kategori_pinjaman_id' => $request->kategori_pinjaman_id,
        'bulan' => $request->bulan,
        'nominal' => $nominal,
        'total_bayar' => $total_bayar,
    ]);

    return redirect()->route('kategori-angsuran.index')->with('success', 'Kategori Angsuran berhasil disimpan.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kategoriAngsuran = KategoriAngsuran::findOrFail($id);
        $kategori_pinjaman = KategoriPinjaman::all();
        return view('pages.kategori-angsuran.edit', compact('kategoriAngsuran', 'kategori_pinjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge([
            'nominal' => str_replace(['Rp.', '.', ','], '', $request->nominal)
        ]);

        $request->validate([
            'kategori_pinjaman_id' => 'required|integer|exists:kategori_pinjaman,id',
            'nominal' => 'required|integer',
            'bulan' => 'required|integer|min:1',
        ]);

        $angsuran = KategoriAngsuran::findOrFail($id);
        $total_bayar = $request->nominal * $request->bulan;

        $angsuran->update([
            'kategori_pinjaman_id' => $request->kategori_pinjaman_id,
            'bulan' => $request->bulan,
            'nominal' => $request->nominal,
            'total_bayar' => $total_bayar,
        ]);

        return redirect()->route('kategori-angsuran.index')->with('success', 'Data Kategori Angsuran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $angsuran = KategoriAngsuran::findOrFail($id);
        $angsuran->delete();

        return redirect()->route('kategori-angsuran.index')->with('success', 'Data Kategori Angsuran berhasil dihapus.');
    }
}

