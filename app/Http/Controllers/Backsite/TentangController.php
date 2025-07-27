<?php

namespace App\Http\Controllers\Backsite;
use App\Http\Controllers\Controller;
use App\Models\Tentang;
use Illuminate\Http\Request;

class TentangController extends Controller
{
    /**
     * Menampilkan semua data tentang.
     */
 public function index()
{
    $tentangs = Tentang::all();
    return view('pages.tentang.index', compact('tentangs'));
}


    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('pages.tentang.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:sejarah,visimisi,profile',
        ]);

        Tentang::create($request->only(['judul', 'isi', 'jenis']));

        return redirect()->route('tentang.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Menampilkan detail data (opsional).
     */
    public function show(Tentang $tentang)
    {
        return view('pages.tentang.show', compact('tentang'));
    }

    /**
     * Menampilkan form edit data.
     */
    public function edit(Tentang $tentang)
    {
        return view('pages.tentang.edit', compact('tentang'));
    }

    /**
     * Menyimpan perubahan data.
     */
    public function update(Request $request, Tentang $tentang)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'jenis' => 'required|in:sejarah,visimisi,profile',
        ]);

        $tentang->update($request->only(['judul', 'isi', 'jenis']));

        return redirect()->route('tentang.index')->with('success', 'Data berhasil diupdate');
    }

    /**
     * Menghapus data.
     */
    public function destroy(Tentang $tentang)
    {
        $tentang->delete();
        return redirect()->route('tentang.index')->with('success', 'Data berhasil dihapus');
    }
}
