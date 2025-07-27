<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    /**
     * Menampilkan semua data galeri.
     */
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('pages.galeri.index', compact('galeris'));
    }

    /**
     * Tampilkan form tambah galeri.
     */
    public function create()
    {
        return view('pages.galeri.create');
    }

    /**
     * Simpan data galeri baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string|max:255',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        Galeri::create($data);

        return redirect()->route('galeri.index')
            ->with('success', 'Data galeri berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit galeri.
     */
    public function edit(Galeri $galeri)
    {
        return view('pages.galeri.edit', compact('galeri'));
    }

    /**
     * Update data galeri.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string|max:255',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }

            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')
            ->with('success', 'Data galeri berhasil diupdate.');
    }

    /**
     * Hapus data galeri.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')
            ->with('success', 'Data galeri berhasil dihapus.');
    }
}
