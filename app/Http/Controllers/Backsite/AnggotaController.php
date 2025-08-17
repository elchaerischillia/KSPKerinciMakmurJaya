<?php

namespace App\Http\Controllers\Backsite;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
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
        $anggota = Anggota::orderBy('created_at', 'asc')->get();
        return view('pages.anggota.index', compact('anggota'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nama_lengkap' => 'required|max:255',
            'nik'          => 'required|min:16|unique:anggota,nik',
            'tgl_lahir'    => 'required|date',
            'tmpt_lahir'   => 'required|max:50',
            'jk'           => 'required|in:Laki-laki,Perempuan',
            'no_hp'        => 'required|max:14|unique:anggota,no_hp',
            'alamat'       => 'required|max:1000',
            'no_rek'       => 'required|max:20|unique:anggota,no_rek',
            'nama_bank'    => 'required|max:255',
            'foto'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'required' => ':attribute harus diisi.',
            'max'      => ':attribute maksimal :max characters.',
            'unique'   => ':attribute sudah ada di database.',
            'in'       => ':attribute harus Laki-laki atau Perempuan.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => ':attribute harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'date'     => ':attribute harus berupa tanggal.',
            'nik'      => ':attribute harus berupa angka.',
        ]);


        // Pastikan direktori penyimpanan ada
        $path = public_path('app/public/assets/file-anggota');
        if (!File::isDirectory($path)) {
            $response = Storage::makeDirectory('public/assets/file-anggota');
        }

        // Proses upload file jika ada foto
        $fotoPath = null; // Variabel untuk menyimpan path foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('assets/file-anggota', 'public');
        }

        // Simpan data anggota ke database
        $anggota = Anggota::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nik'          => $request->nik,
            'tgl_lahir'    => $request->tgl_lahir,
            'tmpt_lahir'   => $request->tmpt_lahir,
            'jk'           => $request->jk,
            'no_rek'       => $request->no_rek,
            'nama_bank'    => $request->nama_bank,
            'foto'         => $fotoPath,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'foto'         => $fotoPath,
            'status'       => true,
        ]);


        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('pages.anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);

        return view('pages.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'nama_lengkap' => 'required|max:255',
            'nik'          => 'required|max:16|unique:anggota,nik,' . $id,
            'tgl_lahir'    => 'required|date',
            'tmpt_lahir'   => 'required|max:50',
            'jk'           => 'required|in:Laki-laki,Perempuan',
            'no_hp'        => 'required|max:14|unique:anggota,no_hp,' . $id,
            'alamat'       => 'required|max:1000',
            'foto'         => 'image|mimes:jpeg,png,jpg|max:2048',
            'status'       => 'required|boolean',
            'no_rek'       => 'required|max:20|unique:anggota,no_rek,' . $id,
            'nama_bank'    => 'required|max:255',
        ], [
            'required' => ':attribute harus diisi.',
            'max'      => ':attribute maksimal :max karakter.',
            'unique'   => ':attribute sudah ada di database.',
            'in'       => ':attribute harus Laki-laki atau Perempuan.',
            'image'    => ':attribute harus berupa gambar.',
            'mimes'    => ':attribute harus berupa gambar dengan ekstensi jpeg, png, atau jpg.',
            'date'     => ':attribute harus berupa tanggal.',
        ]);

        $anggota = Anggota::findOrFail($id);

        // Update file foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            if ($anggota->foto && Storage::exists('public/' . $anggota->foto)) {
                Storage::delete('public/' . $anggota->foto);
            }

            // Simpan file baru
            $fotoPath = $request->file('foto')->store('assets/file-anggota', 'public');
            $anggota->foto = $fotoPath;
        }

        $anggota->update([
            'nama_lengkap' => $request->nama_lengkap,
            'nik'          => $request->nik,
            'tgl_lahir'    => $request->tgl_lahir,
            'tmpt_lahir'   => $request->tmpt_lahir,
            'jk'           => $request->jk,
            'no_rek'       => $request->no_rek,
            'nama_bank'    => $request->nama_bank,
            'no_hp'        => $request->no_hp,
            'alamat'       => $request->alamat,
            'status'       => $request->status,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data karyawan berdasarkan ID
        $anggota =Anggota::findOrFail($id); // Mengambil data user beserta detail user

        // Hapus file foto jika ada
        if ($anggota->foto && Storage::exists('public/' . $anggota->foto)) {
            Storage::delete('public/' . $anggota->foto);
        }

        // Hapus data karyawan
        $anggota->forceDelete();

        return redirect()->route('anggota.index')->with('success', 'Data anggota berhasil dihapus.');
    }
}
