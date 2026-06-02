<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use App\Models\KodeKlasifikasi;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\Auth;

class ArsipController extends Controller
{
    // --- 1. INDEX: Menampilkan Daftar Arsip (Otomatis Filter Sesuai Bidang / Role) ---
    public function index(Request $request)
    {
        $user = Auth::user();

        // Mulai merakit query dasar
        $query = Arsip::with(['unitPengolah', 'kodeKlasifikasi']);

        // 🌟 LOGIKA MATA DEWA MANAJEMEN 🌟
        // Jika BUKAN manajemen, maka batasi hanya tampilkan arsip unitnya sendiri
        if ($user->role != 'manajemen') {
            $query->where('unit_pengolah_id', $user->unit_pengolah_id);
        }

        // Fitur Pencarian Data (Bisa dipakai oleh Manajemen maupun Unit)
        if ($request->filled('judul')) {
            $query->where('judul', 'like', '%' . $request->judul . '%');
        }
        if ($request->filled('indeks')) {
            $query->where('indeks', 'like', '%' . $request->indeks . '%');
        }
        if ($request->filled('uraian_informasi')) {
            $query->where('uraian_informasi', 'like', '%' . $request->uraian_informasi . '%');
        }

        $arsip = $query->orderBy('created_at', 'desc')->paginate(10);

        // Dropdown pencarian judul
        $judulQuery = Arsip::select('judul')->distinct();
        // Batasi juga isi dropdown jika bukan manajemen
        if ($user->role != 'manajemen') {
            $judulQuery->where('unit_pengolah_id', $user->unit_pengolah_id);
        }
        $judulList = $judulQuery->pluck('judul');

        return view('arsip.daftararsip', compact('arsip', 'judulList'));
    }

    // --- 2. CREATE: Menampilkan Form Input ---
    public function create()
    {
        $kodeKlasifikasi = KodeKlasifikasi::all();
        $kategoriBerita = KategoriBerita::all();

        return view('arsip.inputarsip', compact('kodeKlasifikasi', 'kategoriBerita'));
    }

    // --- 3. STORE: Menyimpan Data ke Database ---
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'                  => 'required|string|max:255',
            'nomor_arsip'            => 'nullable|string|max:255',
            'nomor'                  => 'nullable|string|max:255',
            'kode_klasifikasi'       => 'required|integer',
            'kategori_berita'        => 'required|string',
            'indeks'                 => 'nullable|string',
            'uraian_informasi'       => 'nullable|string',
            'tanggal'                => 'nullable|date',
            'tingkat_perkembangan'   => 'required|string',
            'jumlah'                 => 'nullable|integer',
            'satuan'                 => 'nullable|string',
            'unit_pengolah_id'       => 'required|integer',
            'ruangan'                => 'nullable|string',
            'no_box'                 => 'nullable|string',
            'no_filling'             => 'nullable|string',
            'no_laci'                => 'nullable|string',
            'no_folder'              => 'nullable|string',
            'keterangan'             => 'nullable|string',
            'upload_dokumen'         => 'nullable|file|max:30720',
        ]);

        $kategori = ($validated['kategori_berita'] === '-') ? '-' : 'PPID';
        $nomor = $request->input('nomor_arsip', $request->input('nomor', null));

        $arsip = new Arsip();
        $arsip->judul                = $validated['judul'];
        $arsip->nomor_arsip          = $nomor;
        $arsip->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $arsip->kategori             = $kategori;
        $arsip->kategori_berita      = $validated['kategori_berita'];
        $arsip->indeks               = $validated['indeks'] ?? null;
        $arsip->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $arsip->tanggal              = $validated['tanggal'] ?? null;
        $arsip->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $arsip->jumlah               = $validated['jumlah'] ?? null;
        $arsip->satuan               = $validated['satuan'] ?? null;
        $arsip->unit_pengolah_id     = $validated['unit_pengolah_id'];
        $arsip->ruangan              = $validated['ruangan'] ?? null;
        $arsip->no_box               = $validated['no_box'] ?? null;
        $arsip->no_filling           = $validated['no_filling'] ?? null;
        $arsip->no_laci              = $validated['no_laci'] ?? null;
        $arsip->no_folder            = $validated['no_folder'] ?? null;
        $arsip->keterangan           = $validated['keterangan'] ?? null;

        // 🌟 OTOMATIS BERSTATUS PENDING SAAT DIINPUT 🌟
        $arsip->status_verifikasi    = 'pending';

        if ($request->hasFile('upload_dokumen')) {
            $arsip->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $arsip->save();

        return redirect()->route('arsip.index')->with('success', 'Arsip berhasil disimpan dan menunggu verifikasi PPID!');
    }

    // --- 4. EDIT: Menampilkan Form Edit ---
    public function edit($id)
    {
        $arsip = Arsip::findOrFail($id);

        // SENSOR KEAMANAN: Jangan biarkan unit lain (termasuk manajemen) mengedit arsip yang bukan miliknya!
        if ($arsip->unit_pengolah_id !== Auth::user()->unit_pengolah_id) {
            abort(403, 'Akses Ditolak! Ini bukan arsip milik bidang Anda.');
        }

        $kodeKlasifikasi = KodeKlasifikasi::all();
        $kategoriBerita = KategoriBerita::all();

        return view('arsip.editarsip', compact('arsip', 'kodeKlasifikasi', 'kategoriBerita'));
    }

    // --- 5. UPDATE: Menyimpan Perubahan Arsip ---
    public function update(Request $request, $id)
    {
        $arsip = Arsip::findOrFail($id);

        // SENSOR KEAMANAN
        if ($arsip->unit_pengolah_id !== Auth::user()->unit_pengolah_id) {
            abort(403, 'Akses Ditolak! Ini bukan arsip milik bidang Anda.');
        }

        $validated = $request->validate([
            'judul'                  => 'required|string|max:255',
            'nomor_arsip'            => 'nullable|string|max:255',
            'nomor'                  => 'nullable|string|max:255',
            'kode_klasifikasi'       => 'required|integer',
            'kategori_berita'        => 'required|string',
            'indeks'                 => 'nullable|string',
            'uraian_informasi'       => 'nullable|string',
            'tanggal'                => 'nullable|date',
            'tingkat_perkembangan'   => 'required|string',
            'jumlah'                 => 'nullable|integer',
            'satuan'                 => 'nullable|string',
            'unit_pengolah_id'       => 'required|integer',
            'ruangan'                => 'nullable|string',
            'no_box'                 => 'nullable|string',
            'no_filling'             => 'nullable|string',
            'no_laci'                => 'nullable|string',
            'no_folder'              => 'nullable|string',
            'keterangan'             => 'nullable|string',
            'upload_dokumen'         => 'nullable|file|max:10240',
        ]);

        $kategori = ($validated['kategori_berita'] === '-') ? '-' : 'PPID';
        $nomor = $request->input('nomor_arsip', $request->input('nomor', null));

        $arsip->judul                = $validated['judul'];
        $arsip->nomor_arsip          = $nomor;
        $arsip->kode_klasifikasi_id  = (int) $validated['kode_klasifikasi'];
        $arsip->kategori             = $kategori;
        $arsip->kategori_berita      = $validated['kategori_berita'];
        $arsip->indeks               = $validated['indeks'] ?? null;
        $arsip->uraian_informasi     = $validated['uraian_informasi'] ?? null;
        $arsip->tanggal              = $validated['tanggal'] ?? null;
        $arsip->tingkat_perkembangan = $validated['tingkat_perkembangan'];
        $arsip->jumlah               = $validated['jumlah'] ?? null;
        $arsip->satuan               = $validated['satuan'] ?? null;
        $arsip->ruangan              = $validated['ruangan'] ?? null;
        $arsip->no_box               = $validated['no_box'] ?? null;
        $arsip->no_filling           = $validated['no_filling'] ?? null;
        $arsip->no_laci              = $validated['no_laci'] ?? null;
        $arsip->no_folder            = $validated['no_folder'] ?? null;
        $arsip->keterangan           = $validated['keterangan'] ?? null;

        $arsip->status_verifikasi    = 'pending';

        if ($request->hasFile('upload_dokumen')) {
            $arsip->upload_dokumen = $request->file('upload_dokumen')->store('arsip', 'public');
        }

        $arsip->save();

        return redirect()->route('arsip.index')->with('success', 'Data berhasil diperbarui dan dikirim ulang ke PPID!');
    }

    // --- 6. DESTROY: Menghapus Arsip ---
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        // SENSOR KEAMANAN:
        // Tolak akses JIKA user BUKAN ppid, DAN arsip tersebut BUKAN miliknya.
        // Artinya: PPID bebas menghapus apa saja.
        if (Auth::user()->role != 'ppid' && $arsip->unit_pengolah_id !== Auth::user()->unit_pengolah_id) {
            abort(403, 'Akses Ditolak! Anda tidak berhak menghapus arsip ini.');
        }

        $arsip->delete();

        // Menggunakan redirect()->back() agar setelah dihapus, 
        // kembali ke halaman sebelumnya (tidak nyasar ke tempat lain).
        return redirect()->back()->with('success', 'Data arsip berhasil dihapus secara permanen.');
    }

    // --- 7. PPID: Menampilkan Halaman Antrean Verifikasi ---
    public function antreanVerifikasi()
    {
        $arsip = Arsip::with(['unitPengolah', 'kodeKlasifikasi'])
            ->where('status_verifikasi', 'pending')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('arsip.verifikasiarsip', compact('arsip'));
    }

    // --- 8. PPID: Memproses Keputusan (Setuju/Tolak) ---
    public function prosesVerifikasi(Request $request, $id)
    {
        $request->validate([
            'status_verifikasi' => 'required|in:publik,tidak_publik'
        ]);

        $arsip = Arsip::findOrFail($id);
        $arsip->status_verifikasi = $request->status_verifikasi;
        $arsip->save();

        return redirect()->back()->with('success', 'Status arsip berhasil diperbarui!');
    }

    // --- 9. PUBLIK: Menampilkan Daftar Arsip Publik (Telah Disetujui) ---
    public function daftarArsipPublik()
    {
        $arsip = Arsip::with(['unitPengolah', 'kodeKlasifikasi'])
            ->where('status_verifikasi', 'publik')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);

        return view('arsip_publik.daftararsippublik', compact('arsip'));
    }

    public function lihatDokumen($id)
    {
        $arsip = Arsip::findOrFail($id);

        // Ambil path lokasi file asli di dalam folder storage
        $path = storage_path('app/public/' . $arsip->upload_dokumen);

        // Cek apakah filenya benar-benar ada di folder
        if (!file_exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        // Mantra sakti: response()->file() otomatis mengirim header 'inline' ke Chrome
        return response()->file($path);
    }
}
