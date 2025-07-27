<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Struktur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    /**
     * Menampilkan semua data struktur.
     */
    public function index()
    {
        $strukturs = Struktur::latest()->get();
        return view('pages.struktur.index', compact('strukturs'));
    }

    /**
     * Menampilkan form tambah data struktur.
     */
    public function create()
    {
        return view('pages.struktur.create');
    }

    /**
     * Simpan data struktur baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        Struktur::create($data);

        return redirect()->route('struktur.index')
            ->with('success', 'Data struktur berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit data struktur.
     */
    public function edit(Struktur $struktur)
    {
        return view('pages.struktur.edit', compact('struktur'));
    }

    /**
     * Update data struktur.
     */
    public function update(Request $request, Struktur $struktur)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nama']);

        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
                Storage::disk('public')->delete($struktur->foto);
            }

            $data['foto'] = $request->file('foto')->store('struktur', 'public');
        }

        $struktur->update($data);

        return redirect()->route('struktur.index')
            ->with('success', 'Data struktur berhasil diupdate.');
    }

    /**
     * Hapus data struktur.
     */
    public function destroy(Struktur $struktur)
    {
        if ($struktur->foto && Storage::disk('public')->exists($struktur->foto)) {
            Storage::disk('public')->delete($struktur->foto);
        }

        $struktur->delete();

        return redirect()->route('struktur.index')
            ->with('success', 'Data struktur berhasil dihapus.');
    }
}
