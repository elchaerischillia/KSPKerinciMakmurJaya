<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\KategoriSimpan;
use Illuminate\Http\Request;
use App\Helpers\LogActivity;


class KategoriSimpananController extends Controller
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
        $kategori_simpan = KategoriSimpan::all();

        return view('pages.kategori-simpan.index', compact('kategori_simpan'));
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
            'nama_kategori' => 'required|max:255|unique:kategori_simpan,nama_kategori',
        ]);

        KategoriSimpan::create($request->all());

        //logaktivitas
         $data = KategoriSimpanan::create($request->all());
        LogActivity::addToLog('Tambah', 'KategoriSimpanan', 'Menambah kategori simpanan: ' . $data->nama);

        return redirect()->route('kategori-simpan.index')->with('success', 'Data Kategori Simpanan berhasil ditambahkan.');
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
            'nama_kategori' => 'required|max:255|unique:kategori_simpan,nama_kategori,' . $id,
        ]);

        $kategori_simpan = KategoriSimpan::findOrFail($id);
        $kategori_simpan->update($request->all());

        //logaktivitas
        $data = KategoriSimpanan::findOrFail($id);
        $data->update($request->all());
        LogActivity::addToLog('Edit', 'KategoriSimpanan', 'Mengubah kategori simpanan: ' . $data->nama);


        return redirect()->route('kategori-simpan.index')->with('success', 'Data Kategori Simpanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori_simpan = KategoriSimpan::findOrFail($id);
        $kategori_simpan->delete();

        //logaktivitas
         $data = KategoriSimpanan::findOrFail($id);
        $data->delete();
        LogActivity::addToLog('Hapus', 'KategoriSimpanan', 'Menghapus kategori simpanan: ' . $data->nama);


        return redirect()->route('kategori-simpan.index')->with('success', 'Data Kategori Simpanan berhasil dihapus.');
    }
}
