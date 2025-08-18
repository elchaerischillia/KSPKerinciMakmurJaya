<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DetailUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function verifyForm()
    {
        return view('auth.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);

        if (Session::get('otp') == $request->otp) {
            $userId = Session::get('otp_user_id');
            Auth::loginUsingId($userId);

            // Hapus session otp
            Session::forget(['otp', 'otp_user_id']);

            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->with('error', 'Kode OTP salah.');
    }

    // 🔹 Tambahkan ini biar tidak error
    public function resendOtp()
    {
        $userId = Session::get('otp_user_id');
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Sesi OTP tidak ditemukan, silakan login ulang.');
        }

        $detail = DetailUser::where('user_id', $userId)->first();
        if (!$detail || !$detail->no_hp) {
            return redirect()->route('login')->with('error', 'Nomor HP tidak ditemukan.');
        }

        // Generate OTP baru
        $otp = rand(100000, 999999);
        Session::put('otp', $otp);

        // Format no HP
        $no_hp = $detail->no_hp;
        if (str_starts_with($no_hp, '0')) {
            $no_hp = '62' . substr($no_hp, 1);
        }

        // Kirim OTP baru lewat Fonnte
        \App\Services\FonnteService::sendMessage($no_hp, "Kode OTP baru Anda adalah: $otp");

        return back()->with('info', 'Kode OTP baru telah dikirim ke nomor HP Anda.');
    }
}
