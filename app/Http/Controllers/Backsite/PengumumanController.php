<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    /**
     * Menampilkan semua data pengumuman.
     */
    public function index()
    {
        $pengumumen = Pengumuman::all();
        return view('pages.pengumuman.index', compact('pengumumen'));
    }

    /**
     * Menampilkan form tambah pengumuman.
     */
    public function create()
    {
        return view('pages.pengumuman.create');
    }

    /**
     * Menyimpan data pengumuman baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        Pengumuman::create($request->only(['judul', 'isi', 'status']));

        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pengumuman (opsional).
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('pages.pengumuman.show', compact('pengumuman'));
    }

    /**
     * Menampilkan form edit pengumuman.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pages.pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Menyimpan perubahan data pengumuman.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        $pengumuman->update($request->only(['judul', 'isi', 'status']));

        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil diupdate.');
    }

    /**
     * Menghapus pengumuman.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()->route('pengumuman.index')->with('success', 'Data pengumuman berhasil dihapus.');
    }
}
