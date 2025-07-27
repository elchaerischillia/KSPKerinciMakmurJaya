<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
        ],[
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        $data = $request->only('username', 'password');

        if (Auth::attempt($data)) {
            return redirect()->route('dashboard');
        }

        return back()->with([
            'error' => 'Username atau password salah.',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        // Tambahkan flash message setelah logout
        return redirect()->route('login')->with('info', 'Anda telah logout.');
    }
}
