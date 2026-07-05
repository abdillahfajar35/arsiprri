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
            // Jika cocok, buat sesi login
            $request->session()->regenerate();

            // Ambil data user yang baru saja berhasil login
            $user = Auth::user();

            // Racik pesan selamat datang sesuai dengan role masing-masing
            if ($user->role == 'up') {
                // Mengambil nama unit melalui jembatan relasi unitPengolah
                $namaUnit = $user->unitPengolah->nama_unit ?? 'Unit Pengolah';
                $pesan = "Anda berhasil login ke " . $namaUnit;
            } elseif ($user->role == 'ppid') {
                $pesan = "Anda berhasil login ke Operator PPID";
            } elseif ($user->role == 'manajemen') {
                $pesan = "Anda berhasil login ke Manajemen";
            } else {
                $pesan = "Anda berhasil login ke dalam sistem";
            }

            // Alihkan ke dashboard sambil membawa oleh-oleh pesan sukses
            // Ganti baris ini di AuthController.php
            return redirect('/dashboard')->with('login_success', $pesan);
        }

        // Jika salah, kembalikan ke halaman login bawa pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ]);
    }
}
