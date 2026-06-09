@extends('template.main')

@section('content')
<div class="container-fluid px-4 pt-4">
    <h3 class="mb-4">Verifikasi Berkas Arsip</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <strong>Proses ditolak karena:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <table class="table table-bordered bg-white shadow-sm table-hover">
        <thead class="table-dark">
            <tr>
                <th>Judul Arsip</th>
                <th>Nomor Arsip</th>
                <th>Tanggal</th>
                <th width="35%">Aksi Verifikasi (Keputusan)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($arsip as $data)
            <tr>
                <td>{{ $data->judul }}</td>
                <td>{{ $data->nomor_arsip ?? $data->nomor ?? '-' }}</td>
                <td>{{ $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') : '-' }}</td>
                <td>
                    <button type="button" class="btn btn-info btn-sm text-white mr-1" data-toggle="modal" data-target="#modal{{ $data->id }}" title="Lihat Detail">
                        <i class="fas fa-eye"></i> Detail
                    </button>

                    <form action="{{ route('arsip.verifikasi', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menjadikan arsip ini Publik?');">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_verifikasi" value="publik">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Publik
                        </button>
                    </form>

                    <form action="{{ route('arsip.verifikasi', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_verifikasi" value="tidak_publik">
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="fas fa-times"></i> Arsip Unit
                        </button>
                    </form>

                    <!-- ======================================================= -->
                    <!-- MODAL DETAIL ARSIP (VERSI LENGKAP 3 KATEGORI) -->
                    <!-- ======================================================= -->
                    <div class="modal fade text-left" id="modal{{ $data->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold text-primary">Detail Arsip: {{ $data->judul }}</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body p-0">
                                    <table class="table table-bordered table-striped table-sm mb-0 text-left">
                                        <tbody>
                                            <!-- A. DATA ARSIP -->
                                            <tr><th colspan="2" class="bg-light text-primary fw-bold px-3">DATA ARSIP</th></tr>
                                            <tr><th width="35%" class="px-3">Judul</th><td class="px-3">{{ $data->judul }}</td></tr>
                                            <tr><th class="px-3">Nomor Arsip</th><td class="px-3">{{ $data->nomor_arsip ?? $data->nomor ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Kode Klasifikasi</th><td class="px-3">{{ $data->kodeKlasifikasi->kode ?? '-' }} - {{ $data->kodeKlasifikasi->uraian ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Kategori</th><td class="px-3">{{ $data->kategori_berita ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Indeks</th><td class="px-3">{{ $data->indeks ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Uraian Informasi</th><td class="px-3">{{ $data->uraian_informasi ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Tanggal</th><td class="px-3">{{ $data->tanggal ? \Carbon\Carbon::parse($data->tanggal)->format('Y-m-d') : '-' }}</td></tr>
                                            <tr><th class="px-3">Tingkat Perkembangan</th><td class="px-3">{{ $data->tingkat_perkembangan ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Jumlah</th><td class="px-3">{{ $data->jumlah ?? '-' }} {{ $data->satuan ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Unit Pengolah</th><td class="px-3">{{ $data->unitPengolah->nama_unit ?? '-' }}</td></tr>

                                            <!-- B. LOKASI ARSIP -->
                                            <tr><th colspan="2" class="bg-light text-primary fw-bold px-3">LOKASI ARSIP</th></tr>
                                            <tr><th class="px-3">Ruangan</th><td class="px-3">{{ $data->ruangan ?? '-' }}</td></tr>
                                            <tr><th class="px-3">No Box</th><td class="px-3">{{ $data->no_box ?? '-' }}</td></tr>
                                            <tr><th class="px-3">No Filling</th><td class="px-3">{{ $data->no_filling ?? '-' }}</td></tr>
                                            <tr><th class="px-3">No Laci</th><td class="px-3">{{ $data->no_laci ?? '-' }}</td></tr>
                                            <tr><th class="px-3">No Folder</th><td class="px-3">{{ $data->no_folder ?? '-' }}</td></tr>
                                            <tr><th class="px-3">Keterangan</th><td class="px-3">{{ $data->keterangan ?? '-' }}</td></tr>

                                            <!-- C. DOKUMEN & STATUS -->
                                            <tr><th colspan="2" class="bg-light text-primary fw-bold px-3">DOKUMEN & STATUS</th></tr>
                                            <tr>
                                                <th class="px-3">Status Verifikasi</th>
                                                <td class="px-3">
                                                    @if($data->status_verifikasi == 'pending')
                                                        <span class="badge badge-warning text-dark">Menunggu PPID</span>
                                                    @elseif($data->status_verifikasi == 'publik')
                                                        <span class="badge badge-success">Arsip Publik</span>
                                                    @else
                                                        <span class="badge badge-danger">Arsip Unit Saja</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="px-3">Dokumen</th>
                                                <td class="px-3">
                                                    @if($data->upload_dokumen)
                                                        @php
                                                            $ekstensi = pathinfo($data->upload_dokumen, PATHINFO_EXTENSION);
                                                        @endphp

                                                        @if(in_array($ekstensi, ['pdf', 'jpg', 'jpeg', 'png']))
                                                            <a href="{{ route('arsip.lihat', $data->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                                                <i class="fas fa-file-pdf"></i> Lihat File Dokumen
                                                            </a>
                                                        @else
                                                            <a href="{{ route('arsip.lihat', $data->id) }}" class="btn btn-sm btn-success">
                                                                <i class="fas fa-file-word"></i> Unduh Dokumen (Word/Excel)
                                                            </a>
                                                        @endif
                                                    @else
                                                        <span class="text-danger fst-italic">Tidak ada file yang dilampirkan</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END MODAL DETAIL -->
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center text-muted py-4">
                    <i class="fas fa-check-circle mb-2" style="font-size: 24px; color: #28a745;"></i><br>
                    Belum ada data arsip yang perlu diverifikasi.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    
    <div class="d-flex justify-content-end mt-4 mb-2">
        {{ $arsip->links() }}
    </div>
</div>
@endsection