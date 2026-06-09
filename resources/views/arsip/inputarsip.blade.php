@extends('template.main')

@section('content')

<main class="p-3 p-md-4">
    <form action="{{ route('arsip.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <div class="bg-white p-4 p-md-5 rounded shadow-sm mb-4">
            <h2 class="fw-bold mb-4" style="color: #003B69; font-size: 1.25rem;">Input Arsip</h2>
            
            <div class="mb-3">
                <label class="form-label fw-medium">Judul</label>
                <input type="text" name="judul" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Nomor</label>
                <input type="text" name="nomor" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Kode Klasifikasi</label>
                <select id="kode_klasifikasi" name="kode_klasifikasi" class="form-select text-secondary" required>
                    <option value="">-</option>
                    @foreach($kodeKlasifikasi as $kode)     
                        <option value="{{ $kode->id }}">{{ $kode->kode }} - {{ $kode->uraian }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Kategori</label>
                <select id="kategori_berita" name="kategori_berita" class="form-select text-secondary" required>
                    <option value="">-</option>
                    <option value="Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)">Keputusan LPP RRI dan Pertimbangannya (Tersedia setiap saat)</option>
                    <option value="Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)">Kebijakan LPP RRI dan Dokumen Pendukungnya (Tersedia setiap saat)</option>
                    <option value="Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)">Rencana Proyek dan Anggaran Tahunnya (Tersedia setiap saat)</option>
                    <option value="Rencana Strategis LPP RRI (Tersedia setiap saat)">Rencana Strategis LPP RRI (Tersedia setiap saat)</option>
                    <option value="Informasi tentang PPID LPP RRI (Tersedia setiap saat)">Informasi tentang PPID LPP RRI (Tersedia setiap saat)</option>
                    <option value="Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)">Informasi tentang Penindakan atas Pelanggaran yang dilakukan oleh Pegawai LPP RRI (Tersedia setiap saat)</option>
                    <option value="Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)">Informasi Daftar dan Hasil Penelitian LPP RRI (Tersedia setiap saat)</option>
                    <option value="Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)">Informasi Laporan Harta Kekayaan Pejabat Negara di LPP RRI yang telah diverifikasi oleh KPK (Tersedia setiap saat)</option>
                    <option value="Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)">Perjanjian LPP RRI dengan Pihak Ketiga (Tersedia setiap saat)</option>
                    <option value="Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)">Informasi dalam pertemuan yang bersifat untuk umum (Tersedia setiap saat)</option>
                    <option value="Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)">Prosedur Kerja yang Berkaitan dengan Publik (Tersedia setiap saat)</option>
                    <option value="Laporan Layanan Akses Informasi (Tersedia setiap saat)">Laporan Layanan Akses Informasi (Tersedia setiap saat)</option>
                    <option value="Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)">Profil Lengkap Pimpinan dan Pegawai (Tersedia setiap saat)</option>

                    <option value="Informasi Berkaitan dengan Profile LPP RRI (Berkala)">Informasi Berkaitan dengan Profile LPP RRI (Berkala)</option>
                    <option value="Alamat LPP RRI (Berkala)">Alamat LPP RRI (Berkala)</option>
                    <option value="Struktur Organisasi (Berkala)">Struktur Organisasi (Berkala)</option>
                    <option value="Sejarah Singkat LPP RRI (Berkala)">Sejarah Singkat LPP RRI (Berkala)</option>
                    <option value="Profil Pejabat LPP RRI (Berkala)">Profil Pejabat LPP RRI (Berkala)</option>
                    <option value="RKAKL LPP RRI (Berkala)">RKAKL LPP RRI (Berkala)</option>
                    <option value="Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)">Informasi Agenda Terkait Pelaksanaan Tugas LPP RRI (Berkala)</option>
                    <option value="DIPA (Berkala)">DIPA (Berkala)</option>
                    <option value="Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)">Informasi Penerimaan Calon Pegawai LPP RRI (Berkala)</option>
                    <option value="Laporan Keuangan Audited (Berkala)">Laporan Keuangan Audited (Berkala)</option>
                    <option value="Rencana dan LRA (Berkala)">Rencana dan LRA (Berkala)</option>
                    <option value="Neraca Keuangan (Berkala)">Neraca Keuangan (Berkala)</option>
                    <option value="Laporan Arus Kas dan CaLK (Berkala)">Laporan Arus Kas dan CaLK (Berkala)</option>
                    <option value="Daftar Investasi dan Asset (Administrasi BMN) (Berkala)">Daftar Investasi dan Asset (Administrasi BMN) (Berkala)</option>
                    <option value="Acara Siaran (Berkala)">Acara Siaran (Berkala)</option>
                    <option value="Laporan Bidang TMB (Berkala)">Laporan Bidang TMB (Berkala)</option>
                    <option value="Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)">Laporan Bidang Pemberitaan/Tim Penyiaran (Berkala)</option>
                    <option value="Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)">Laporan Bidang Siaran/Tim Konten Media Baru (Berkala)</option>
                    <option value="Laporan Bidang LPU (Berkala)">Laporan Bidang LPU (Berkala)</option>
                    <option value="Laporan Bidang SDM dan Umum (Berkala)">Laporan Bidang SDM dan Umum (Berkala)</option>
                    <option value="Daftar Informasi Publik LPP RRI (Berkala)">Daftar Informasi Publik LPP RRI (Berkala)</option>
                    <option value="Laporan Akuntabilitas (Berkala)">Laporan Akuntabilitas (Berkala)</option>
                    <option value="ELHKPN LPP RRI (Berkala)">ELHKPN LPP RRI (Berkala)</option>
                    <option value="Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)">Regulasi dan Rancangan Keterbukaan Informasi Publik (Berkala)</option>
                    <option value="Rancangan Peraturan di LPP RRI (Berkala)">Rancangan Peraturan di LPP RRI (Berkala)</option>
                    <option value="Regulasi LPP RRI (Berkala)">Regulasi LPP RRI (Berkala)</option>
                    <option value="SOP (Berkala)">SOP (Berkala)</option>
                    <option value="Pengadaan Barang dan Jasa (Berkala)">Pengadaan Barang dan Jasa (Berkala)</option>
                    <option value="Standar Pelayanan (Berkala)">Standar Pelayanan (Berkala)</option>
                    <option value="Maklumat Pelayanan (Berkala)">Maklumat Pelayanan (Berkala)</option>
                    <option value="Ringkasan Program Strategis LPP RRI (Berkala)">Ringkasan Program Strategis LPP RRI (Berkala)</option>
                    <option value="Dokumen Surat Menyurat (Berkala)">Dokumen Surat Menyurat (Berkala)</option>
                    <option value="Informasi Terkait Penanganan Covid-19 (Berkala)">Informasi Terkait Penanganan Covid-19 (Berkala)</option>
                    <option value="Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)">Opini BPK RI atas Laporan Keuangan LPP RRI (Berkala)</option>
                    <option value="Penyelenggaraan Satu Data Indonesia (Berkala)">Penyelenggaraan Satu Data Indonesia (Berkala)</option>
                    <option value="Bintang Radio RRI Tingkat Nasional (Berkala)">Bintang Radio RRI Tingkat Nasional (Berkala)</option>
                    <option value="Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)">Formulir Pendaftaran PTQ RRI ke-53 Tahun 2023 (Berkala)</option>
                    <option value="Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)">Informasi Publik dalam Bahasa Isyarat Indonesia (BISINDO) (Berkala)</option>
                    <option value="LHKPN Kepala RRI Seluruh Indonesia (Berkala)">LHKPN Kepala RRI Seluruh Indonesia (Berkala)</option>
                    <option value="Press Release (Berkala)">Press Release (Berkala)</option>
                    <option value="Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)">Formulir Pendaftaran PTQ RRI ke-54 Tahun 2024 (Berkala)</option>
                    <option value="Laporan Tahunan LPP RRI (Berkala)">Laporan Tahunan LPP RRI (Berkala)</option>
                    <option value="Rencana Umum Pengadaan (Berkala)">Rencana Umum Pengadaan (Berkala)</option>
                    <option value="Peraturan, Keputusan dan Kebijakan (Berkala)">Peraturan, Keputusan dan Kebijakan (Berkala)</option>
                    <option value="Regulasi Pedoman Pengelolaan Informasi (Berkala)">Regulasi Pedoman Pengelolaan Informasi (Berkala)</option>
                    <option value="Regulasi Pedoman Pengelolaan Administrasi (Berkala)">Regulasi Pedoman Pengelolaan Administrasi (Berkala)</option>
                    <option value="Regulasi Pedoman Pengelolaan Personil (Berkala)">Regulasi Pedoman Pengelolaan Personil (Berkala)</option>
                    <option value="Rancangan Peraturan (Berkala)">Rancangan Peraturan (Berkala)</option>
                    <option value="Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)">Masukan dari Berbagai Pihak atas Peraturan, Keputusan atau Kebijakan (Berkala)</option>
                    <option value="Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)">Risalah Rapat dari Proses Pembentukan Peraturan, Keputusan atau Kebijakan (Berkala)</option>
                    <option value="Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)">Dokumen Rancangan Peraturan, Keputusan Kebijakan yang dibentuk (Berkala)</option>
                    <option value="Dokumen Penghargaan (Berkala)">Dokumen Penghargaan (Berkala)</option>
                    <option value="LHKPN Dewas dan Direksi (Berkala)">LHKPN Dewas dan Direksi (Berkala)</option>
                    <option value="Hasil Monitoring dan Evaluasi KIP (Berkala)">Hasil Monitoring dan Evaluasi KIP (Berkala)</option>
                    <option value="Pedoman HUT LPP RRI 80th (Berkala)">Pedoman HUT LPP RRI 80th (Berkala)</option>

                    <option value="Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)">Informasi yang Wajib Diumumkan Tanpa Penundaan (Serta Merta)</option>
                    <option value="Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)">Menyangkut Ancaman Terhadap Hajat Hidup Orang Banyak dan Ketertiban Umum (Serta Merta)</option>
                    <option value="Pasal 17 UU 14 Tahun 2008 (Dikecualikan)">Pasal 17 UU 14 Tahun 2008 (Dikecualikan)</option>
                </select>
            </div>
            
            <input type="hidden" id="kategori" name="kategori" value="-">

            <div class="mb-3">
                <label class="form-label fw-medium">Indeks</label>
                <input type="text" name="indeks" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Uraian Informasi</label>
                <textarea name="uraian_informasi" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Tanggal</label>
                <input type="date" name="tanggal" class="form-control text-secondary" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Tingkat Perkembangan</label>
                <select name="tingkat_perkembangan" class="form-select text-secondary" required>
                    <option value="Asli">Asli</option>
                    <option value="Fotocopy">Fotocopy</option>
                    <option value="Asli & Fotocopy">Asli & Fotocopy</option>
                    <option value="Softcopy">Softcopy</option>
                </select>
            </div>

            <div class="mb-3 form-group-jumlah">
                <label class="form-label fw-medium">Jumlah</label>
                <div class="d-flex gap-3">
                    <input type="number" name="jumlah" min="0" class="form-control text-center" style="max-width: 120px;" placeholder="0" required>
                    <select name="satuan" class="form-select text-secondary" style="max-width: 150px;" required>
                        <option value="lembar">Lembar</option>
                        <option value="jilid">Jilid</option>
                        <option value="bundle">Bundle</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Unit Pengolah Arsip</label>
                <input type="text" value="{{ auth()->user()->name }}" class="form-control bg-light text-secondary" readonly>
                <input type="hidden" name="unit_pengolah_id" value="{{ Auth::user()->unit_pengolah_id }}"> 
            </div>

        </div> 
        
        <div class="bg-white p-4 p-md-5 rounded shadow-sm">
            <h2 class="fw-semibold mb-4" style="color: #003B69; font-size: 1.25rem;">Lokasi Arsip</h2>
            
            <div class="mb-3">
                <label class="form-label fw-medium">Ruangan</label>
                <input type="text" name="ruangan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Box</label>
                <input type="text" name="no_box" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Filling</label>
                <input type="text" name="no_filling" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Laci</label>
                <input type="text" name="no_laci" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Folder</label>
                <input type="text" name="no_folder" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Upload Dokumen</label>
                <input type="file" name="upload_dokumen" class="form-control">
            </div>

            <div class="d-flex justify-content-end gap-3 mt-5">
                <a href="{{ route('arsip.index') }}" class="btn btn-secondary px-4 shadow-sm">Kembali</a>
                <button type="submit" class="btn text-white px-4 shadow-sm" style="background-color: #003B69;">Simpan</button>
            </div>
        </div>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formInput = document.querySelector('form');

        formInput.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Cari semua elemen wajib (input, select, textarea)
            let elemenWajib = formInput.querySelectorAll('input[required], select[required], textarea[required]');

            elemenWajib.forEach(function(elemen) {
                // Bersihkan tampilan error lama
                elemen.classList.remove('is-invalid');
                let parentDiv = elemen.closest('.mb-3');
                let errorLama = parentDiv.querySelector('.pesan-error-js');
                if (errorLama) errorLama.remove();

                // Jika elemen dibiarkan kosong
                if (elemen.value.trim() === '') {
                    isValid = false;
                    elemen.classList.add('is-invalid'); // Tambah border merah

                    // Buat pesan error merah
                    let pesanError = document.createElement('small');
                    pesanError.className = 'text-danger fw-bold mt-1 d-block pesan-error-js';
                    pesanError.innerText = '* Kolom ini wajib diisi!';

                    // Sisipkan pesan error ke dalam parent terdekat agar rapi
                    parentDiv.appendChild(pesanError);
                }
            });

            // Jika ada yang kosong, cegat form dan scroll ke error teratas
            if (!isValid) {
                event.preventDefault();
                let errorPertama = formInput.querySelector('.is-invalid');
                if (errorPertama) {
                    errorPertama.focus();
                    errorPertama.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Hapus merah-merah secara otomatis saat user mulai mengetik/memilih
        formInput.addEventListener('input', function(event) {
            if (event.target.hasAttribute('required')) {
                event.target.classList.remove('is-invalid');
                let parentDiv = event.target.closest('.mb-3');
                if (parentDiv) {
                    let errorLama = parentDiv.querySelector('.pesan-error-js');
                    if (errorLama) errorLama.remove();
                }
            }
        });

        // Tambahan khusus untuk elemen <select> agar merahnya hilang saat opsi diklik
        formInput.addEventListener('change', function(event) {
            if (event.target.tagName === 'SELECT' && event.target.hasAttribute('required')) {
                event.target.classList.remove('is-invalid');
                let parentDiv = event.target.closest('.mb-3');
                if (parentDiv) {
                    let errorLama = parentDiv.querySelector('.pesan-error-js');
                    if (errorLama) errorLama.remove();
                }
            }
        });
    });
</script>

@endsection