<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Helpers\LogActivity;

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

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
        $user = Auth::user();

        // generate OTP random 6 digit
        $otp = rand(100000, 999999);

        // simpan OTP ke session
        Session::put('otp', $otp);
        Session::put('otp_user_id', $user->id);

        // logging aktivitas
        LogActivity::addToLog('Login', 'Auth', "User {$user->username} berhasil login, OTP dikirim.");

        // sementara tampilkan di log
        \Log::info("OTP untuk user {$user->username}: " . $otp);

        return redirect()->route('otp.verify');
    }

    LogActivity::addToLog('Login Gagal', 'Auth', "Percobaan login gagal dengan username {$request->username}");
    return back()->with('error', 'Username atau Password salah!')->withInput();
}


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
