<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $galeris = Galeri::latest()->get();
        return view('pages.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('pages.galeri.create');
    }

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
        } else {
            // kasih default biar tidak error
            $data['foto'] = 'default/galeri.png'; 
        }

        Galeri::create($data);

        return redirect()->route('galeri.index')
            ->with('success', 'Data galeri berhasil ditambahkan.');
    }

    public function edit(Galeri $galeri)
    {
        return view('pages.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'required|string|max:255',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('foto')) {
            if ($galeri->foto && Storage::disk('public')->exists($galeri->foto)) {
                Storage::disk('public')->delete($galeri->foto);
            }
            $data['foto'] = $request->file('foto')->store('galeri', 'public');
        } else {
            // kalau update dan tidak upload, jangan dihapus biar tetap pakai yang lama
            $data['foto'] = $galeri->foto ?? 'default/galeri.png';
        }

        $galeri->update($data);

        return redirect()->route('galeri.index')
            ->with('success', 'Data galeri berhasil diupdate.');
    }

    public function destroy(Galeri $galeri)
    {
        if ($galeri->foto && Storage::disk('public')->exists($galeri->foto) && $galeri->foto !== 'default/galeri.png') {
            Storage::disk('public')->delete($galeri->foto);
        }

        $galeri->delete();

        return redirect()->route('galeri.index')
            ->with('success', 'Data galeri berhasil dihapus.');
    }
}
