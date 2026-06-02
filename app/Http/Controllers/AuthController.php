<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function prosesLogin(Request $request)
    {
        // Validasi inputan
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // kecocokan dengan database MySQL
        if (Auth::attempt($credentials)) {
            // Jika cocok, buat sesi login dan arahkan ke dashboard
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // Jika salah, kembalikan ke halaman login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }
}
