<?php

namespace App\Http\Controllers\Backsite;

use Carbon\Carbon;
use App\Models\Anggota;
use App\Models\Angsuran;
use App\Models\Pinjaman;
use App\Models\Pembayaran;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\KategoriAngsuran;
use App\Models\KategoriPinjaman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Helpers\LogActivity;

class PinjamanController extends Controller
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
        $pinjaman = Pinjaman::with('anggota', 'kategori_angsuran', 'kategori_pinjaman', 'user')
            ->orderBy('created_at', 'desc')->get();

        return view('pages.pinjaman.index', compact('pinjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategori_pinjaman = KategoriPinjaman::all();
        $kategori_angsuran = KategoriAngsuran::all();
        $anggota = Anggota::all();

        return view('pages.pinjaman.create', compact('kategori_angsuran', 'anggota', 'kategori_pinjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|integer|exists:anggota,id',
            'kategori_angsuran_id' => 'required|integer|exists:kategori_angsuran,id',
            'kategori_pinjaman_id' => 'required|integer|exists:kategori_pinjaman,id',
            'tanggal_pinjam' => 'required|date',
            'angunan' => 'required|string',
            'bukti_angunan' => 'required|mimes:jpeg,png,jpg,docx,pdf|max:2048',
        ]);

         // Pastikan direktori penyimpanan ada
         $path = public_path('app/public/assets/file-agunan');
         if (!File::isDirectory($path)) {
             $response = Storage::makeDirectory('public/assets/file-agunan');
         }

         // Proses upload file jika ada foto
         $fotoPath = null; // Variabel untuk menyimpan path foto
         if ($request->hasFile('bukti_angunan')) {
             $fotoPath = $request->file('bukti_angunan')->store('assets/file-agunan', 'public');
         }

        Pinjaman::create([
            'user_id'    => auth()->user()->id,
            'kategori_pinjaman_id' => $request->kategori_pinjaman_id,
            'kategori_angsuran_id' => $request->kategori_angsuran_id,
            'anggota_id' => $request->anggota_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'angunan' => $request->angunan,
            'status_pengajuan'    => 'Pending',
            'bukti_angunan' => $fotoPath
        ]);

        //logaktivitas
        $data = Pinjaman::create($request->all());
        LogActivity::addToLog('Tambah', 'Pinjaman', 'Menambah pinjaman untuk anggota ID: ' . $data->anggota_id);


        return redirect()->route('pinjaman.index')->with('success', 'Data Pinjaman berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pinjaman = Pinjaman::with('anggota', 'kategori_angsuran', 'kategori_pinjaman', 'user')
            ->findOrFail($id);

        return view('pages.pinjaman.detail', compact('pinjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $kategori_pinjaman = KategoriPinjaman::all();
        $kategori_angsuran = KategoriAngsuran::all();
        $anggota = Anggota::all();


        return view('pages.pinjaman.edit', compact('pinjaman', 'anggota', 'kategori_pinjaman', 'kategori_angsuran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the incoming data
        $request->validate([
            'anggota_id' => 'required|integer|exists:anggota,id',
            'kategori_angsuran_id' => 'required|integer|exists:kategori_angsuran,id',
            'kategori_pinjaman_id' => 'required|integer|exists:kategori_pinjaman,id',
            'tanggal_pinjam' => 'required|date',
            'angunan' => 'required|string',
            'bukti_angunan' => 'nullable|mimes:jpeg,png,jpg,doc,pdf|max:5098',
        ]);

        // Find the Pinjaman record by ID
        $pinjaman = Pinjaman::findOrFail($id);

        // Update file foto jika ada
        if ($request->hasFile('bukti_angunan')) {
            // Hapus file lama jika ada
            if ($pinjaman->bukti_angunan && Storage::exists('public/' . $pinjaman->bukti_angunan)) {
                Storage::delete('public/' . $pinjaman->bukti_angunan);
            }

            // Simpan file baru
            $fotoPath = $request->file('bukti_angunan')->store('assets/file-agunan', 'public');
            $pinjaman->bukti_angunan = $fotoPath;
        }

        // Update the record with the new data
        $pinjaman->update([
            'user_id' => auth()->user()->id,
            'kategori_pinjaman_id' => $request->kategori_pinjaman_id,
            'kategori_angsuran_id' => $request->kategori_angsuran_id,
            'anggota_id' => $request->anggota_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'angunan' => $request->angunan,
            'status_pengajuan' => 'Pending', // Or set it as necessary
        ]);

        //logaktivitas
        $data = Pinjaman::findOrFail($id);
        $data->update($request->all());
        LogActivity::addToLog('Edit', 'Pinjaman', 'Mengubah pinjaman ID: ' . $data->id);


        // Redirect to the index page with success message
        return redirect()->route('pinjaman.index')->with('success', 'Data Pinjaman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pinjaman = Pinjaman::findOrFail($id);
        $pinjaman->forcedelete();

        //LOGAKTIVITAS
         $data = Pinjaman::findOrFail($id);
         $data->delete();

         LogActivity::addToLog('Hapus', 'Pinjaman', 'Menghapus pinjaman ID: ' . $data->id);


        return redirect()->route('pinjaman.index')->with('success', 'Data Pinjaman berhasil dihapus.');
    }

    public function statusApproved($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        // Perbarui status pengajuan
        $pinjaman->update([
            'status_pengajuan' => 'Approved',
        ]);

        // Buat angsuran
        $this->buatAngsuran($pinjaman);

        return redirect()->back()->with('success', 'Pinjaman berhasil disetujui');
    }

    public function statusRejected($id)
    {
        $pinjaman = Pinjaman::findOrFail($id);

        // Perbarui status pengajuan
        $pinjaman->update([
            'status_pengajuan' => 'Rejected',
        ]);

        return redirect()->back()->with('success', 'Pinjaman berhasil ditolak.');
    }

    // membuat angsuran otomatis
    protected function buatAngsuran(Pinjaman $pinjaman)
    {
        $kategoriAngsuran = $pinjaman->kategori_angsuran; // Relasi ke model kategori_angsuran
        $tanggalPinjaman = Carbon::parse($pinjaman->tanggal_pinjam);

        for ($i = 1; $i <= $kategoriAngsuran->bulan; $i++) {
            Angsuran::create([
                'pinjaman_id' => $pinjaman->id,
                'tgl_jatuh_tempo' => $tanggalPinjaman->copy()->addMonths($i),
                'status' => 'Belum Bayar',
            ]);
        }
    }

    // menampilkan halaman transaksi
    public function showTransaksiPinjaman($id)
    {
        $pinjaman = Pinjaman::with('anggota', 'kategori_angsuran', 'kategori_pinjaman', 'user')
            ->findOrFail($id);

        $angsuran = Angsuran::where('pinjaman_id', $id)->get();

        return view('pages.pinjaman.transaksi-pinjam', compact('pinjaman', 'angsuran'));
    }

    public function showPembayaran(Request $request, $id)
    {

        $angsuran = Angsuran::findOrFail($id);

        $pembayaran = $angsuran->pembayaran->first();

        //tab
        $tab = $request->get('tab', 'angsuran');

        return view('pages.pinjaman.pembayaran', compact('angsuran'));
    }

    public function bayarAngsuran(Request $request, $id)
    {
        // Menghapus simbol mata uang dan format dari nominal
        $request->merge(['nominal' => str_replace(['Rp.', '.', ','], '', $request->nominal)]);
        // Cari data angsuran
        $angsuran = Angsuran::findOrFail($id);


        $request->validate([
            'nominal' => 'required|integer|min:1',
            'keterangan' => 'nullable|string|max:255',
            'bukti_trans' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'metode_pembayaran' => 'required|in:Cash,Transfer',
        ]);



        // Validasi tambahan: memastikan nominal tidak melebihi jumlah angsuran
        if ($request->nominal != $angsuran->pinjaman->kategori_angsuran->nominal) {
            return redirect()->back()->withErrors(['nominal' => 'Nominal pembayaran harus ' . 'Rp. ' . (number_format($angsuran->pinjaman->kategori_angsuran->nominal, 0, ',', '.'))]);
        }

        // Pastikan direktori penyimpanan ada
        $directoryPath = 'public/assets/file-bukti-transfer';
        if (!Storage::exists($directoryPath)) {
            Storage::makeDirectory($directoryPath);
        }

        // Proses upload file jika ada bukti transfer
        $fotoPath = null;
        if ($request->hasFile('bukti_trans')) {
            $fotoPath = $request->file('bukti_trans')->store($directoryPath, 'public');
        }

        // Update status angsuran menjadi "Lunas"
        $angsuran->update([
            'status' => 'Lunas',
        ]);

        // Buat data pembayaran baru
        $angsuran->pembayaran()->create([
            'kode_trans' => $this->generateKodeTransaksi(),
            'user_id' => auth()->user()->id,
            'nominal' => $request->nominal,
            'keterangan' => $request->keterangan,
            'bukti_trans' => $fotoPath,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => true,
        ]);

        // Redirect ke halaman pinjaman dengan pesan sukses
        return redirect()
            ->route('pinjaman.transaksi', $angsuran->pinjaman) // Perbaikan rute ini
            ->with('success', 'Pembayaran berhasil dilakukan.');
    }

    // menampilkan laporan
    public function showPembayaranAngsuran($id)
    {
        $angsuran = Angsuran::findOrFail($id);
        $pembayaran = $angsuran->pembayaran->first();

        return view('pages.pinjaman.bukti-pembayaran', compact('angsuran', 'pembayaran'));
    }



// mendownload bukti pembayaran
public function downloadBukti($id)
{
    $angsuran = Angsuran::findOrFail($id);
    $pembayaran = $angsuran->pembayaran->first();

    if (!$pembayaran) {
        return redirect()->back()->with('error', 'Data pembayaran tidak ditemukan.');
    }

    // Hitung angsuran keberapa
    $angsuranKe = Angsuran::where('pinjaman_id', $angsuran->pinjaman_id)
        ->where('id', '<=', $angsuran->id)
        ->count();

    $totalAngsuran = $angsuran->pinjaman->kategori_angsuran->bulan ?? 0;

    $nomorTransaksi = $pembayaran->kode_trans ?? 'bukti-pembayaran';
    $filename = 'bukti-pembayaran-' . $nomorTransaksi . '.pdf';

    // Setting mPDF ukuran struk
    $mpdf = new \Mpdf\Mpdf([
        'mode' => 'utf-8',
        'format' => [110, 215], // Lebar 80mm, tinggi cukup agar 1 lembar
        'margin_left' => 2,
        'margin_right' => 2,
        'margin_top' => 2,
        'margin_bottom' => 2
    ]);

    // Render HTML struk
    $html = view('pages.pinjaman.bukti-pembayaran', compact('angsuran', 'pembayaran', 'angsuranKe', 'totalAngsuran'))->render();

    $mpdf->WriteHTML($html);
    $mpdf->Output($filename, 'D');
}



    // mengambil data kategori angsuran berdasarkan besar pinjaman yang dinputkan
    public function getKategoriAngsuran(Request $request)
    {
        $angsuran = KategoriAngsuran::where('kategori_pinjaman_id', $request->kategori_pinjaman_id)->get();

        return response()->json($angsuran);
    }



    private function generateKodeTransaksi()
    {
        return 'TRX-PJM' . strtoupper(Str::random(8)) . '-' . now()->timestamp;
    }
}
