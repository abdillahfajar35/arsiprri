@extends('template.main')

@section('content')

<main class="p-3 p-md-4">
    <form action="{{ route('arsip.update', $arsip->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')

        {{-- Data Arsip --}}
        <div class="bg-white p-4 p-md-5 rounded shadow-sm mb-4">
            <h2 class="fw-bold mb-4" style="color:#003B69;">
                Edit Arsip
            </h2>

            <div class="mb-3">
                <label class="form-label fw-medium">Judul</label>
                <input type="text"
                       name="judul"
                       class="form-control"
                       value="{{ old('judul', $arsip->judul) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Nomor</label>
                <input type="text"
                       name="nomor"
                       class="form-control"
                       value="{{ old('nomor', $arsip->nomor) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Kode Klasifikasi</label>
                <select name="kode_klasifikasi" class="form-select" required>
                    <option value="">-</option>

                    @foreach($kodeKlasifikasi as $kode)
                        <option value="{{ $kode->id }}"
                            {{ old('kode_klasifikasi', $arsip->kode_klasifikasi_id) == $kode->id ? 'selected' : '' }}>
                            {{ $kode->kode }} - {{ $kode->uraian }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Kategori</label>
                <select name="kategori_berita" class="form-select" required>
                    <option value="">-</option>
                    @foreach($kategoriBerita as $kat)
                        <option value="{{ $kat->nama_kategori }}"
                            {{ old('kategori_berita', $arsip->kategori_berita) == $kat->nama_kategori ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <input type="hidden"
                   name="kategori"
                   value="{{ old('kategori', $arsip->kategori) }}">

            <div class="mb-3">
                <label class="form-label fw-medium">Indeks</label>
                <input type="text"
                       name="indeks"
                       class="form-control"
                       value="{{ old('indeks', $arsip->indeks) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Uraian Informasi</label>
                <textarea name="uraian_informasi"
                          class="form-control"
                          rows="3"
                          required>{{ old('uraian_informasi', $arsip->uraian_informasi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Tanggal</label>
                <input type="date"
                       name="tanggal"
                       class="form-control"
                       value="{{ old('tanggal', $arsip->tanggal) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Tingkat Perkembangan</label>
                <select name="tingkat_perkembangan" class="form-select" required>
                    <option value="Asli"
                        {{ old('tingkat_perkembangan', $arsip->tingkat_perkembangan) == 'Asli' ? 'selected' : '' }}>
                        Asli
                    </option>
                    <option value="Fotocopy"
                        {{ old('tingkat_perkembangan', $arsip->tingkat_perkembangan) == 'Fotocopy' ? 'selected' : '' }}>
                        Fotocopy
                    </option>
                    <option value="Asli & Fotocopy"
                        {{ old('tingkat_perkembangan', $arsip->tingkat_perkembangan) == 'Asli & Fotocopy' ? 'selected' : '' }}>
                        Asli & Fotocopy
                    </option>
                    <option value="Softcopy"
                        {{ old('tingkat_perkembangan', $arsip->tingkat_perkembangan) == 'Softcopy' ? 'selected' : '' }}>
                        Softcopy
                    </option>
                </select>
            </div>

            <div class="mb-3 form-group-jumlah">
                <label class="form-label fw-medium">Jumlah</label>
                <div class="d-flex gap-3">
                    <input type="number"
                           name="jumlah"
                           min="0"
                           class="form-control text-center"
                           style="max-width:120px;"
                           value="{{ old('jumlah', $arsip->jumlah) }}"
                           required>

                    <select name="satuan"
                            class="form-select"
                            style="max-width:150px;"
                            required>
                        <option value="lembar" {{ old('satuan', $arsip->satuan) == 'lembar' ? 'selected' : '' }}>Lembar</option>
                        <option value="jilid" {{ old('satuan', $arsip->satuan) == 'jilid' ? 'selected' : '' }}>Jilid</option>
                        <option value="bundle" {{ old('satuan', $arsip->satuan) == 'bundle' ? 'selected' : '' }}>Bundle</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Unit Pengolah Arsip</label>
                <input type="text"
                       value="{{ auth()->user()->name }}"
                       class="form-control bg-light"
                       readonly>
                <input type="hidden"
                       name="unit_pengolah_id"
                       value="{{ Auth::user()->unit_pengolah_id }}">
            </div>
        </div>

        {{-- Lokasi Arsip --}}
        <div class="bg-white p-4 p-md-5 rounded shadow-sm mb-4">
            <h2 class="fw-semibold mb-4" style="color:#003B69;">
                Lokasi Arsip
            </h2>

            <div class="mb-3">
                <label class="form-label fw-medium">Ruangan</label>
                <input type="text"
                       name="ruangan"
                       class="form-control"
                       value="{{ old('ruangan', $arsip->ruangan) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Box</label>
                <input type="text"
                       name="no_box"
                       class="form-control"
                       value="{{ old('no_box', $arsip->no_box) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Filling</label>
                <input type="text"
                       name="no_filling"
                       class="form-control"
                       value="{{ old('no_filling', $arsip->no_filling) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Laci</label>
                <input type="text"
                       name="no_laci"
                       class="form-control"
                       value="{{ old('no_laci', $arsip->no_laci) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">No Folder</label>
                <input type="text"
                       name="no_folder"
                       class="form-control"
                       value="{{ old('no_folder', $arsip->no_folder) }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Keterangan</label>
                <textarea name="keterangan"
                          class="form-control"
                          rows="3"
                          required>{{ old('keterangan', $arsip->keterangan) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-medium">Upload Dokumen</label>
                @if($arsip->upload_dokumen)
                    <div class="mb-2">
                        <small class="text-success fw-bold">
                            File saat ini: {{ $arsip->upload_dokumen }}
                        </small>
                    </div>
                @endif
                <input type="file"
                       name="upload_dokumen"
                       class="form-control">
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="{{ route('arsip.index') }}" class="btn btn-secondary">
                    Kembali
                </a>
                <button type="submit" class="btn text-white" style="background-color:#003B69;">
                    Simpan Perubahan
                </button>
            </div>
        </div>

    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const formEdit = document.querySelector('form');

        formEdit.addEventListener('submit', function(event) {
            let isValid = true;
            
            // Cari semua elemen wajib
            let elemenWajib = formEdit.querySelectorAll('input[required], select[required], textarea[required]');

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
                let errorPertama = formEdit.querySelector('.is-invalid');
                if (errorPertama) {
                    errorPertama.focus();
                    errorPertama.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });

        // Hapus merah-merah secara otomatis saat user mulai mengetik/memilih
        formEdit.addEventListener('input', function(event) {
            if (event.target.hasAttribute('required')) {
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