<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    /**
     * Tampilkan semua data kontak.
     */
    public function index()
    {
        $kontaks = Kontak::all();

        return view('pages.kontak.index', compact('kontaks'));
    }

    /**
     * Tampilkan form untuk membuat data kontak.
     */
    public function create()
    {
        return view('pages.kontak.create');
    }

    /**
     * Simpan data kontak baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'maps' => 'nullable|string',
            'jam_buka' => 'nullable|string|max:255',
        ]);

        Kontak::create($request->only([
            'alamat',
            'no_hp',
            'email',
            'maps',
            'jam_buka',
        ]));

        return redirect()->route('kontak.index')->with('success', 'Data kontak berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail data kontak.
     */
    public function show(Kontak $kontak)
    {
        return view('pages.kontak.show', compact('kontak'));
    }

    /**
     * Tampilkan form edit data kontak.
     */
    public function edit(Kontak $kontak)
    {
        return view('pages.kontak.edit', compact('kontak'));
    }

    /**
     * Update data kontak di database.
     */
    public function update(Request $request, Kontak $kontak)
    {
        $request->validate([
            'alamat' => 'required|string|max:255',
            'no_hp' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'maps' => 'nullable|string',
            'jam_buka' => 'nullable|string|max:255',
        ]);

        $kontak->update($request->only([
            'alamat',
            'no_hp',
            'email',
            'maps',
            'jam_buka',
        ]));

        return redirect()->route('kontak.index')->with('success', 'Data kontak berhasil diupdate.');
    }

    /**
     * Hapus data kontak.
     */
    public function destroy(Kontak $kontak)
    {
        $kontak->delete();

        return redirect()->route('kontak.index')->with('success', 'Data kontak berhasil dihapus.');
    }
}
