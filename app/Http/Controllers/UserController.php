<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UnitPengolah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // ============================================================
    // SENSOR KEAMANAN PENGGANTI CONSTRUCT (Khusus Laravel 11/12)
    // ============================================================
    private function cekAksesPPID()
    {
        if (Auth::user()->role != 'ppid') {
            abort(403, 'Akses Ditolak! Hanya operator PPID yang berhak mengatur akun pengguna.');
        }
    }

    // 1. Tampilkan Daftar User
    public function index()
    {
        $this->cekAksesPPID(); // Panggil sensor keamanan

        $users = User::with('unitPengolah')->orderBy('created_at', 'desc')->paginate(10);
        $unitPengolah = UnitPengolah::all();

        return view('users.index', compact('users', 'unitPengolah'));
    }

    // 2. Simpan User Baru
    public function store(Request $request)
    {
        $this->cekAksesPPID(); // Panggil sensor keamanan

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => 'required|string|min:6|confirmed',
            'role'             => 'required|string',
            'unit_pengolah_id' => 'nullable|integer'
        ]);

        User::create([
            'name'             => $request->name,
            'email'            => $request->email,
            'password'         => Hash::make($request->password),
            'role'             => $request->role,
            'unit_pengolah_id' => $request->unit_pengolah_id,
        ]);

        return redirect()->back()->with('success', 'Akun pengguna berhasil ditambahkan!');
    }

    // 3. Update Data User & Password
    public function update(Request $request, $id)
    {
        $this->cekAksesPPID(); // Panggil sensor keamanan

        $user = User::findOrFail($id);

        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role'             => 'required|string',
            'unit_pengolah_id' => 'nullable|integer',
            'password'         => 'nullable|string|min:6|confirmed' // 👈 Tambahkan baris ini
        ]);

        $user->name             = $request->name;
        $user->email            = $request->email;
        $user->role             = $request->role;
        $user->unit_pengolah_id = $request->unit_pengolah_id;

        // JIKA KOLOM PASSWORD DIISI, MAKA GANTI PASSWORDNYA
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Data akun berhasil diperbarui!');
    }

    // 4. Hapus User
    public function destroy($id)
    {
        $this->cekAksesPPID(); // Panggil sensor keamanan

        $user = User::findOrFail($id);

        // Cegah PPID menghapus akunnya sendiri secara tidak sengaja
        if ($user->id == Auth::id()) {
            return redirect()->back()->withErrors('Anda tidak bisa menghapus akun yang sedang Anda gunakan sendiri!');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Akun pengguna berhasil dihapus!');
    }
}
