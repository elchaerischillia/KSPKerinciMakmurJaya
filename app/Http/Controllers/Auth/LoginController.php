<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    // tampilkan form login
    public function showLogin()
    {
        return view('auth.login');
    }

    // proses login
    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // cek username & password
        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password
        ])) {
            $user = Auth::user();

            // generate OTP random 6 digit
            $otp = rand(100000, 999999);

            // simpan OTP ke session (bisa juga ke DB user)
            Session::put('otp', $otp);
            Session::put('otp_user_id', $user->id);

            // TODO: Kirim OTP via Email / WhatsApp
            // sementara kita simpan ke log biar bisa dilihat
            \Log::info("OTP untuk user {$user->username}: " . $otp);

            // redirect ke halaman verifikasi OTP
            return redirect()->route('otp.verify');
        }

        // kalau gagal login
        return back()->with('error', 'Username atau Password salah!')
                     ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
