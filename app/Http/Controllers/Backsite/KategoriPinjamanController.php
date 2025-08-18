<?php

namespace App\Http\Controllers\Backsite;

use Illuminate\Http\Request;
use App\Models\KategoriPinjaman;
use App\Http\Controllers\Controller;
use App\Helpers\LogActivity;


class KategoriPinjamanController extends Controller
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
        $kategori_pinjaman = \App\Models\KategoriPinjaman::all();

        return view('pages.kategori-pinjaman.index', compact('kategori_pinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nama_kategori' => 'required|max:255|unique:kategori_pinjaman,nama_kategori',
        'jumlah_pinjaman' => 'required|numeric|min:100000',
    ]);

    KategoriPinjaman::create($request->only('nama_kategori', 'jumlah_pinjaman'));

    //logaktivitas
    $data = KategoriPinjaman::create($request->all());
    LogActivity::addToLog('Tambah', 'KategoriPinjaman', 'Menambah kategori pinjaman: ' . $data->nama);

    return redirect()->route('kategori-pinjaman.index')->with('success', 'Data Kategori Pinjaman berhasil ditambahkan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id)
{
    $request->validate([
        'nama_kategori' => 'required|max:255|unique:kategori_pinjaman,nama_kategori,' . $id,
        'jumlah_pinjaman' => 'required|numeric|min:100000',
    ]);

    $kategori_pinjaman = KategoriPinjaman::findOrFail($id);
    $kategori_pinjaman->update($request->only('nama_kategori', 'jumlah_pinjaman'));

    //logaktivitas
    $data = KategoriPinjaman::findOrFail($id);
    $data->update($request->all());

    LogActivity::addToLog('Edit', 'KategoriPinjaman', 'Mengubah kategori pinjaman: ' . $data->nama);

    return redirect()->route('kategori-pinjaman.index')->with('success', 'Data Kategori Pinjaman berhasil diperbarui.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori_simpan = KategoriPinjaman::findOrFail($id);
        $kategori_simpan->delete();

        //logaktivitas
         $data = KategoriPinjaman::findOrFail($id);
        $data->delete();

        LogActivity::addToLog('Hapus', 'KategoriPinjaman', 'Menghapus kategori pinjaman: ' . $data->nama);


        return redirect()->route('kategori-pinjaman.index')->with('success', 'Data Kategori Pinjaman berhasil dihapus.');
    }
}
