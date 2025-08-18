<?php

namespace App\Http\Controllers\Backsite;

use App\Models\Anggota;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use App\Models\KategoriSimpan;
use App\Models\TransaksiSimpan;
use App\Http\Controllers\Controller;
use App\Helpers\LogActivity;

class SimpanController extends Controller
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
        $simpanan = Simpanan::with('anggota', 'user', 'kategori_simpan')
            ->orderBy('created_at', 'desc')->get(); // Menambahkan get() untuk mengambil data

        return view('pages.simpan.index', compact('simpanan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $anggota = Anggota::all(); // Semua anggota
        $kategori_simpan = KategoriSimpan::all(); // Semua kategori
        return view('pages.simpan.create', compact('anggota', 'kategori_simpan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->merge(['saldo_simpanan' => str_replace(['Rp.', '.', ','], '', $request->saldo_simpanan)]);

    $request->validate([
        'anggota_id' => 'required|exists:anggota,id',
        'kategori_simpan_id' => 'required|exists:kategori_simpan,id',
        'keterangan' => 'nullable|max:1000',
        'saldo_simpanan' => 'required|integer',
        'metode_pembayaran' => 'required|in:Cash,Transfer',
    ]);

    // 🔥 Periksa dulu apakah anggota sudah punya kategori ini
    $exists = Simpanan::where('anggota_id', $request->anggota_id)
        ->where('kategori_simpan_id', $request->kategori_simpan_id)
        ->exists();

    if ($exists) {
        return redirect()->back()->withErrors(['error' => 'Anggota sudah memiliki kategori simpanan ini.']);
    }

    // Kalau belum ada → simpan data
    $simpanan = Simpanan::create([
        'user_id'            => auth()->id(),
        'anggota_id'         => $request->anggota_id,
        'kategori_simpan_id' => $request->kategori_simpan_id,
        'status'             => true,
        'saldo_simpanan'     => $request->saldo_simpanan,
    ]);

    // Tambah transaksi pertama
    $saldoBaru = (int)$request->saldo_simpanan;

    TransaksiSimpan::create([
        'simpanan_id'       => $simpanan->id,
        'kode_transaksi'    => $this->generateKodeTransaksi(),
        'nominal'           => $saldoBaru,
        'keterangan'        => $request->keterangan,
        'metode_pembayaran' => $request->metode_pembayaran,
        'jenis_transaksi'   => 'Simpan',
        'saldo_akhir'       => $saldoBaru,
        'user_id'           => auth()->id(),
        'status'            => true,
    ]);

    // Logging
    LogActivity::addToLog('Tambah', 'Simpanan', 'Menambah simpanan untuk anggota ID: ' . $simpanan->anggota_id);

    return redirect()->route('simpan.index')->with('success', 'Data Anggota Simpan berhasil ditambahkan.');
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
        $simpanan = Simpanan::findOrFail($id);
        $anggota = Anggota::all();
        $kategori_simpan = KategoriSimpan::all();
        $transaksi_simpan = $simpanan->transaksi_simpan->first(); // Access the first item of the collection

        return view('pages.simpan.edit', compact('simpanan', 'anggota', 'kategori_simpan', 'transaksi_simpan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->merge(['saldo_simpanan' => str_replace(['Rp.', '.', ','], '', $request->saldo_simpanan)]);

        $simpanan = Simpanan::findOrFail($id);
        $transaksi = $simpanan->transaksi_simpan->first();


        $request->validate([
            'anggota_id' => 'required|exists:anggota,id',
            'kategori_simpan_id' => 'required|exists:kategori_simpan,id',
            'no_rek' => 'required|unique:simpanan,no_rek,' . $simpanan->id,
            'nama_bank' => 'required',
            'keterangan' => 'nullable|max:1000',
            'saldo_simpanan' => 'required|integer',
            'metode_pembayaran' => 'required|in:Cash,Transfer',
        ], [
            'required' => ':attribute harus diisi.',
            'exists' => ':attribute harus ada di database.',
            'unique' => ':attribute sudah ada di database.',
            'max' => ':attribute maksimal :max karakter.',
        ]);

        //logaktivitas
         $data = Simpanan::findOrFail($id);
        $data->update($request->all());

        LogActivity::addToLog('Edit', 'Simpanan', 'Mengubah simpanan ID: ' . $data->id);

        // memeriksa apakah anggota tersebut sudah terdaftar di kategori tersebut
        $exists = Simpanan::where('anggota_id', $request->anggota_id)
            ->where('kategori_simpan_id', $request->kategori_simpan_id)
            ->exists();

        // jika sudah terdaftar maka akan muncul alert
        if ($exists) {
            return redirect()->back()->withErrors(['error' => 'Anggota sudah memiliki kategori simpanan ini.']);
        }

        $simpanan->update([
            'user_id'               => auth()->id(),
            'anggota_id'            => $request->anggota_id,
            'kategori_simpan_id'    => $request->kategori_simpan_id,
            'nama_bank'             => $request->nama_bank,
            'no_rek'                => $request->no_rek,
            'status'                => $request->status,
            'saldo_simpanan'        => $request->saldo_simpanan,
        ]);

        $saldoBaru = (int)$request->saldo_simpanan;

        $transaksi->update([
            'simpanan_id'       => $simpanan->id,
            'nominal'           => $saldoBaru,
            'keterangan'        => $request->keterangan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'user_id'           => auth()->id(),
            'status'            => true,
            'saldo_akhir'       => $saldoBaru,
            'jenis_transaksi'   => 'Simpan',

        ]);

        return redirect()->route('simpan.index')->with('success', 'Data Anggota Simpan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $simpanan = Simpanan::findOrFail($id);
    $simpanan->delete();

    LogActivity::addToLog('Hapus', 'Simpanan', 'Menghapus simpanan ID: ' . $simpanan->id);

    return redirect()->route('simpan.index')->with('success', 'Data simpanan berhasil dihapus.');
}





    public function simpanTransaksi(Request $request, $id)
    {
        $request->merge(['nominal' => str_replace(['Rp.', '.', ','], '', $request->nominal)]);


        $simpan = Simpanan::findOrFail($id);

        $request->validate([
            'nominal' => 'required|integer|min:1',
            'keterangan' => 'nullable|max:1000', // Keterangan tidak wajib
            'metode_pembayaran' => 'required|in:Cash,Transfer',
        ], [
            'required' => ':attribute harus diisi.',
            'integer' => ':attribute harus berupa angka.',
            'min' => ':attribute harus lebih dari 0.',
            'max' => ':attribute maksimal :max karakter.',
            'in' => ':attribute harus salah satu dari: Cash atau Transfer.',
        ]);

        $saldoBaru = $simpan->saldo_simpanan + (int)$request->nominal;


        // tambah saldo
        $simpan->update([
            'saldo_simpanan' => $saldoBaru,
        ]);


        // Tambahkan transaksi
        $simpan->transaksi_simpan()->create([
            'kode_transaksi' => $this->generateKodeTransaksi(),
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'user_id' => auth()->id(),
            'status' => true, // Status default berhasil
            'simpanan_id' => $simpan->id,
            'saldo_akhir' => $saldoBaru,
            'jenis_transaksi' => 'Simpan'
        ]);

        return back()->with('success', 'Transaksi berhasil disimpan.');
    }

    public function penarikanTransaksi(Request $request, $id)
    {
        // Menghapus format Rp., titik, dan koma dari nominal
        $request->merge(['nominal' => str_replace(['Rp.', '.', ','], '', $request->nominal)]);

        // Mencari data Simpanan berdasarkan ID
        $simpan = Simpanan::findOrFail($id);

        // Validasi input
        $request->validate([
            'nominal' => 'required|integer|min:1',
            'keterangan' => 'nullable|max:1000', // Keterangan tidak wajib
            'metode_pembayaran' => 'required|in:Cash,Transfer',
        ], [
            'required' => ':attribute harus diisi.',
            'integer' => ':attribute harus berupa angka.',
            'min' => ':attribute harus lebih dari 0.',
            'max' => ':attribute maksimal :max karakter.',
            'in' => ':attribute harus salah satu dari: Cash atau Transfer.',
        ]);

        // Cek saldo untuk memastikan nominal penarikan tidak lebih besar dari saldo yang ada
        if ($request->nominal > $simpan->saldo_simpanan) {
            return redirect()->back()->withErrors(['nominal' => 'Nominal penarikan tidak boleh melebihi saldo saat ini.']);
        }

        $saldoBaru = $simpan->saldo_simpanan - (int)$request->nominal;


        // Mengurangi saldo dengan nominal penarikan
        $simpan->update([
            'saldo_simpanan' => $saldoBaru,
        ]);



        // Tambahkan transaksi penarikan
        $simpan->transaksi_simpan()->create([
            'kode_transaksi' => $this->generateKodeTransaksi(),
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'user_id' => auth()->id(),
            'status' => true, // Status transaksi berhasil
            'simpanan_id' => $simpan->id,
            'saldo_akhir' => $saldoBaru,
            'jenis_transaksi' => 'Tarik', // Pastikan jenis transaksi adalah 'Tarik'
        ]);

        // Kembalikan ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Transaksi Penarikan berhasil disimpan.');
    }

    public function showTransaksiSimpan(Request $request, $id)
    {

        $simpan = Simpanan::findOrFail($id);
        $transaksi_simpan = TransaksiSimpan::where('simpanan_id', $id)
            ->orderBy('created_at', 'desc')->paginate(5);


        $kategori_simpan = KategoriSimpan::all();

        $tab = $request->get('tab', 'simpan'); // Default ke tab 'simpan' jika tidak ada parameter 'tab'


        return view('pages.simpan.transaksi-simpan', compact('simpan', 'kategori_simpan', 'transaksi_simpan', 'tab'));
    }

    public function showSimpanan($id)
    {

        $simpan = Simpanan::findOrFail($id);
        $transaksi_simpan = $simpan->transaksi_simpan->first();


        return view('pages.simpan.bukti-simpanan', compact('simpan', 'transaksi_simpan'));
    }


    public function downloadBuktiSimpanan($id)
    {
        // Ambil transaksi berdasarkan ID yang dipilih
    $transaksi_simpan = TransaksiSimpan::findOrFail($id);

    // Generasi file PDF
    $mpdf = new \Mpdf\Mpdf();
    $simpan = $transaksi_simpan->simpanan;  // Ambil simpanan terkait transaksi
    $htmlContent = view('pages.simpan.bukti-simpanan', compact('simpan', 'transaksi_simpan'))->render();
    $mpdf->WriteHTML($htmlContent);

    // Output file PDF
    $fileName = 'bukti-simpanan-' . $transaksi_simpan->kode_transaksi . '.pdf';
    return $mpdf->Output($fileName, 'D'); // Menampilkan file PDF di browser
    }






    public function generateKodeTransaksi()
    {
        // Ambil tanggal hari ini
        $tanggal = now()->format('Ymd'); // Format: 20241205

        // Hitung jumlah transaksi yang sudah ada hari ini
        $count = TransaksiSimpan::whereDate('created_at', now())->count() + 1;

        // Buat kode transaksi
        $kodeTransaksi = 'TRX-SIM' . $tanggal . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);

        return $kodeTransaksi;
    }
}
