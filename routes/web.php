<?php

use App\Models\KategoriAngsuran;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Backsite\SimpanController;
use App\Http\Controllers\Backsite\AnggotaController;
use App\Http\Controllers\Backsite\LaporanController;
use App\Http\Controllers\Backsite\AngsuranController;
use App\Http\Controllers\Backsite\KaryawanController;
use App\Http\Controllers\Backsite\PinjamanController;
use App\Http\Controllers\Backsite\TentangController;
use App\Http\Controllers\Backsite\StrukturController;
use App\Http\Controllers\Backsite\KontakController;
use App\Http\Controllers\Backsite\GaleriController;
use App\Http\Controllers\Backsite\DashboardController;
use App\Http\Controllers\Backsite\PengumumanController;
use App\Http\Controllers\Backsite\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Backsite\KategoriAngsuranController;
use App\Http\Controllers\Backsite\KategoriPinjamanController;
use App\Http\Controllers\Backsite\KategoriSimpananController;
use App\Http\Controllers\Backsite\AngsuranTerlambatWebController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\ActivityLogController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');



Route::get('/galerihome', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/pengumumanhome', [HomeController::class, 'pengumuman'])->name('pengumuman');
Route::get('/faqhome', [HomeController::class, 'faq'])->name('faq');
Route::get('/contacthome', [HomeController::class, 'contact'])->name('kontak');
Route::post('/kontakhome', [HomeController::class, 'contactStore'])->name('kontak.store');
Route::get('/strukturhome', [HomeController::class, 'struktur'])->name('struktur');



//route showlogin
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/proses-login', [LoginController::class, 'loginProses'])->name('proses-login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    //route dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //route Karyawan
    Route::resource('/karyawan', KaryawanController::class);
    Route::resource('tentang', TentangController::class);
    Route::resource('struktur', StrukturController::class);
    Route::resource('kontak', KontakController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('faq', FaqController::class);




    //route anggota
    Route::resource('/anggota', AnggotaController::class);

    //route kategori
    Route::resource('/kategori-simpan', KategoriSimpananController::class);

    // route transaksi simpan
    Route::resource('/simpan', SimpanController::class);
    Route::get('/simpan/transaksi-simpan/{id}', [SimpanController::class, 'showTransaksiSimpan'])->name('simpan.transaksi_simpan');
    Route::put('/simpan/tambah-simpan/{id}', [SimpanController::class, 'simpanTransaksi'])->name('simpan.tambah_simpan');
    Route::put('/simpan/penarikan-simpan/{id}', [SimpanController::class, 'penarikanTransaksi'])->name('simpan.penarikan_simpan');
    Route::delete('/simpan/{id}', [App\Http\Controllers\Backsite\SimpanController::class, 'destroy'])->name('simpan.destroy');


    // route kategori pinjaman
    Route::resource('/kategori-pinjaman', KategoriPinjamanController::class);

    // route kategori angsuran
    Route::resource('/kategori-angsuran', KategoriAngsuranController::class);

    // route pinjaman
    Route::resource('/pinjaman', PinjamanController::class);
    // route mengabil data kategori angsuran
    Route::post('/get-kategori-angsuran', [PinjamanController::class, 'getKategoriAngsuran'])->name('getKategoriAngsuran');
    // route approved peminjaman
    Route::put('/pinjaman/approved/{id}', [PinjamanController::class, 'statusApproved'])->name('pinjaman.approved');
    // route rejected peminjaman
    Route::put('/pinjaman/rejected/{id}', [PinjamanController::class, 'statusRejected'])->name('pinjaman.rejected');

    // route peminjaman
    Route::get('/pinjaman/angsuran/{id}', [PinjamanController::class, 'showTransaksiPinjaman'])->name('pinjaman.transaksi');
    Route::get('/pinjaman/angsuran/pembayaran/{id}', [PinjamanController::class, 'showPembayaran'])->name('angsuran.bayar');
    Route::put('/pinjaman/angsuran/pembayaran/bayar/{id}', [PinjamanController::class, 'bayarAngsuran'])->name('pinjaman.bayar');

    //route angsuran
    Route::resource('/angsuran-bermasalah', AngsuranController::class);

    //route bukti-pembayaran
    Route::get('/bukti-pembayaran/{id}', [PinjamanController::class, 'showPembayaranAngsuran'])->name('pembayaran.bukti');
    Route::get('/bukti-pembayaran/pdf/{id}', [PinjamanController::class, 'downloadBukti'])->name('pembayaran.download');

    //route buktisimpan
    Route::get('/bukti-simpanan/{id}', [SimpanController::class, 'showSimpanan'])->name('simpan.bukti');
    Route::get('/bukti-simpanan/pdf/{id}', [SimpanController::class, 'downloadBuktiSimpanan'])->name('simpan.download');

    // Route untuk menampilkan halaman laporan peminjaman
    Route::get('/laporan/peminjaman', [LaporanController::class, 'showLaporanPeminjaman'])->name('laporan.peminjaman');
    // Route untuk mencetak laporan dalam bentuk HTML
    Route::get('/laporan/peminjaman/cetak', [LaporanController::class, 'cetakLaporanPeminjaman'])->name('laporan.peminjaman.cetak');
    // Route untuk mencetak laporan dalam bentuk PDF
    Route::get('/laporan/peminjaman/cetak-pdf', [LaporanController::class, 'cetakLaporanPeminjamanPdf'])->name('laporan.peminjaman.cetak-pdf');

    // Route untuk menampilkan halaman laporan simpanan
    Route::get('/laporan/simpanan', [LaporanController::class, 'showLaporanSimpanan'])->name('laporan.simpanan');
    // Route untuk mencetak laporan dalam bentuk HTML
    Route::get('/laporan/simpanan/cetak', [LaporanController::class, 'cetakLaporanSimpanan'])->name('laporan.simpanan.cetak');
    // Route untuk mencetak laporan dalam bentuk PDF dam cari
    Route::get('/laporan/simpanan/cari_simpanan', [LaporanController::class, 'cetakLaporanSimpananPdf'])->name('laporan.simpanan.cetak-pdf');

      // Route untuk menampilkan halaman laporan angsuran
      Route::get('/laporan/angsuran', [LaporanController::class, 'showLaporanAngsuran'])->name('laporan.angsuran');
      // Route untuk mencetak laporan dalam bentuk HTML
      Route::get('/laporan/angsuran/cetak', [LaporanController::class, 'cetakLaporanAngsuran'])->name('laporan.angsuran.cetak');
      // Route untuk mencetak laporan dalam bentuk PDF
      Route::get('/laporan/angsuran/cetak-pdf', [LaporanController::class, 'cetakLaporanAngsuranPdf'])->name('laporan.angsuran.cetak-pdf');


    //Route untuk notif wa angsuran bermaslaah 
    Route::post('/angsuran/{id}/notify', [AngsuranTerlambatWebController::class, 'notify'])
    ->name('angsuran.notify');

    //verifikasi
   

    Route::get('/otp-verify', [TwoFactorController::class, 'VerifyForm'])->name('otp.verify');
    Route::post('/otp-verify', [TwoFactorController::class, 'verifyOtp'])->name('otp.check');

    // kalau mau fitur resend OTP
    Route::post('/resend-otp', [TwoFactorController::class, 'resendOtp'])->name('resend.otp');
    //logactivity
    Route::get('/log-activity', [LogActivityController::class, 'index'])->name('log-activity.index');


  }); 
