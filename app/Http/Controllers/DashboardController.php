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

        // =================================================================
        // 1. JIKA YANG LOGIN ADALAH PPID
        // =================================================================
        if ($user->role == 'ppid') {

            $statistikUnit = UnitPengolah::withCount('arsip')->get();
            $totalPublik = Arsip::where('status_verifikasi', 'publik')->count();
            $totalBelumVerif = Arsip::where('status_verifikasi', 'pending')->count();
            $totalSudahVerif = Arsip::where('status_verifikasi', '!=', 'pending')->count();

            // Tambahan: Ambil 5 antrean arsip terbaru yang belum diverifikasi
            $arsipTerbaru = Arsip::where('status_verifikasi', 'pending')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return view('dashboard_roles.ppid', compact('statistikUnit', 'totalPublik', 'totalBelumVerif', 'totalSudahVerif', 'arsipTerbaru'));
        }
        // =================================================================
        // 2. JIKA YANG LOGIN ADALAH MANAJEMEN
        // =================================================================
        elseif ($user->role == 'manajemen') {

            $totalSemuaArsip = Arsip::count();
            $totalPublik = Arsip::where('status_verifikasi', 'publik')->count();

            // Tambahan: Ambil 5 arsip terbaru secara keseluruhan (global)
            $arsipTerbaru = Arsip::orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return view('dashboard_roles.manajemen', compact('totalSemuaArsip', 'totalPublik', 'arsipTerbaru'));
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

            // Tambahan: Ambil 5 arsip terbaru khusus milik unit pengolah yang sedang login
            $arsipTerbaru = Arsip::where('unit_pengolah_id', $unitId)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            return view('dashboard_roles.up', compact('totalArsipUnit', 'totalPublik', 'totalBelumVerif', 'totalSudahVerif', 'arsipTerbaru'));
        }
    }
}
