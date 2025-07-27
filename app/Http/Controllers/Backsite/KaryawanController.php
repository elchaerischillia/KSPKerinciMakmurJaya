<?php

namespace App\Http\Controllers\Backsite;

use App\Models\User;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class KaryawanController extends Controller
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
        $karyawan = User::with('detail_user')->orderBy('created_at', 'desc')->get();

        return view('pages.karyawan.index', compact('karyawan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.karyawan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validasi
        $request->validate([
            'nama_lengkap'  => 'required|max:255',
            'username'      => 'required|unique:users,username|max:255',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tmpt_lahir'    => 'required|max:255',
            'tgl_lahir'     => 'required|date',
            'jk'            => 'required|in:Laki-laki,Perempuan',
            'no_hp'         => 'required|max:14|unique:detail_user,no_hp',
            'alamat'        => 'required|max:1000',
        ]);

        // Pastikan direktori penyimpanan ada
        $path = public_path('app/public/assets/file-karyawan');
        if (!File::isDirectory($path)) {
            $response = Storage::makeDirectory('public/assets/file-karyawan');
        }

        // Proses upload file jika ada foto
        $fotoPath = null; // Variabel untuk menyimpan path foto
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('assets/file-karyawan', 'public');
        }

        // Simpan data karyawan
        $karyawan = User::create([
            'nama_lengkap'  => $request->nama_lengkap,
            'username'      => $request->username,
            'password'      => Hash::make('123456'),
            'role'          => $request->role,
        ]);

        // Simpan data detail user
        $detail_user = DetailUser::create([
            'user_id' => $karyawan->id, // Menggunakan ID karyawan yang baru dibuat
            'tmpt_lahir' => $request->tmpt_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jk' => $request->jk,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'status' => true, // default true
            'foto' => $fotoPath,
        ]);

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $karyawan = User::with('detail_user')->findOrFail($id);
        // Mengambil data user beserta detail user
        return view('pages.karyawan.show', compact('karyawan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $karyawan = User::with('detail_user')->findOrFail($id); // Mengambil data user beserta detail user
        return view('pages.karyawan.edit', compact('karyawan'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap'  => 'required|max:255',
            'username'      => 'required|string|max:20|unique:users,username,' . $id,
            'password'      => 'nullable|string|min:6',
            'role'          => 'required|in:Manager,Teller,Collector',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tmpt_lahir'    => 'required|max:255',
            'tgl_lahir'     => 'required|date',
            'jk'            => 'required|in:Laki-laki,Perempuan',
            'no_hp'         => 'required|max:14|unique:detail_user,no_hp,' . $id,
            'alamat'        => 'required|max:1000',
            'status'        => 'required|boolean', // Ensure 'status' is required only if needed
        ]);

        $karyawan = User::with('detail_user')->findOrFail($id); // Mengambil data user beserta detail user

        // Update file foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus file lama jika ada
            if ($karyawan->detail_user->foto && Storage::exists('public/' . $karyawan->detail_user->detail_user->foto)) {
                Storage::delete('public/' . $karyawan->detail_user->foto);
            }

            // Simpan file baru
            $fotoPath = $request->file('foto')->store('assets/file-karyawan', 'public');
            $karyawan->detail_user->foto = $fotoPath;
        }

        // Update data karyawan
        $karyawan->update([
            'nama_lengkap'  => $request->nama_lengkap,
            'username'      => $request->username,
            'password'      => $request->password ? Hash::make($request->password) : $karyawan->password,
            'role'          => $request->role,
        ]);

        // Update data detail user
        $karyawan->detail_user->update([
            'tmpt_lahir'    => $request->tmpt_lahir,
            'tgl_lahir'     => $request->tgl_lahir,
            'jk'            => $request->jk,
            'no_hp'         => $request->no_hp,
            'alamat'        => $request->alamat,
            'status'        => $request->status, // You may want to make sure this is needed
        ]);

        // Redirect back with a success message
        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Ambil data karyawan berdasarkan ID
        $karyawan = User::with('detail_user')->findOrFail($id); // Mengambil data user beserta detail user

        // Hapus file foto jika ada
        if ($karyawan->detail_user->foto && Storage::exists('public/' . $karyawan->foto)) {
            Storage::delete('public/' . $karyawan->detail_user->foto);
        }

        // Hapus data karyawan
        $karyawan->delete();

        return redirect()->route('karyawan.index')->with('success', 'Data karyawan berhasil dihapus.');
    }
}
