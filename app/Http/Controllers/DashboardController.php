<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Models\UnitPengolah;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // ⚠️ PENTING: Ganti kata 'role' di bawah ini dengan nama kolom hak akses di tabel users-mu.
        // (Misalnya: $user->level, $user->hak_akses, atau $user->kategori)

        // =================================================================
        // 1. JIKA YANG LOGIN ADALAH PPID
        // =================================================================
        if ($user->role == 'ppid') {

            $statistikUnit = UnitPengolah::withCount('arsip')->get();
            $totalPublik = Arsip::where('status_verifikasi', 'publik')->count();
            $totalBelumVerif = Arsip::where('status_verifikasi', 'pending')->count();
            $totalSudahVerif = Arsip::where('status_verifikasi', '!=', 'pending')->count();

            return view('dashboard_roles.ppid', compact('statistikUnit', 'totalPublik', 'totalBelumVerif', 'totalSudahVerif'));
        }
        // =================================================================
        // 2. JIKA YANG LOGIN ADALAH MANAJEMEN
        // =================================================================
        elseif ($user->role == 'manajemen') {

            // Silakan sesuaikan data apa saja yang ingin dilihat manajemen
            $totalSemuaArsip = Arsip::count();
            $totalPublik = Arsip::where('status_verifikasi', 'publik')->count();

            return view('dashboard_roles.manajemen', compact('totalSemuaArsip', 'totalPublik'));
        }
        // =================================================================
        // 3. JIKA YANG LOGIN ADALAH UNIT PENGOLAH (DEFAULT)
        // =================================================================
        else {

            $unitId = $user->unit_pengolah_id;

            $totalArsipUnit = Arsip::where('unit_pengolah_id', $unitId)->count();
            $totalPublik = Arsip::where('status_verifikasi', 'publik')->count();
            $totalBelumVerif = Arsip::where('unit_pengolah_id', $unitId)->where('status_verifikasi', 'pending')->count();
            $totalSudahVerif = Arsip::where('unit_pengolah_id', $unitId)->where('status_verifikasi', '!=', 'pending')->count();

            return view('dashboard_roles.up', compact('totalArsipUnit', 'totalPublik', 'totalBelumVerif', 'totalSudahVerif'));
        }
    }
}
