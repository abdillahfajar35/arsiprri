@extends('template.main')

@section('content')
<main class="p-3 p-md-4">
    <div class="bg-white p-4 rounded shadow-sm mb-4">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h2 class="fw-bold m-0" style="color:#003B69;">
                <i class="fas fa-folder-open me-2"></i> Daftar Arsip Unit
            </h2>
        </div>

        <div class="row mt-4 mb-3 px-3">
            <div class="col-md-5 offset-md-7">
                <form action="{{ url()->current() }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari Judul atau Nomor Arsip..." value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" title="Cari Data">
                                <i class="fas fa-search"></i> Cari
                            </button>
                            @if(request('search'))
                                <a href="{{ url()->current() }}" class="btn btn-danger" title="Reset Pencarian">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark" style="background-color: #1c3b5a;">
                    <tr>
                        <th class="text-center" width="5%">No</th>
                        <th>Judul Arsip</th>
                        <th>Nomor Arsip</th>
                        <th>Tingkat Perkembangan</th>
                        <th>Tanggal</th>
                        <th class="text-center">Status Verifikasi</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsip as $index => $item)
                    <tr>
                        <td class="text-center">{{ $arsip->firstItem() + $index }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->nomor_arsip ?? '-' }}</td>
                        <td>{{ $item->tingkat_perkembangan }}</td>
                        <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '-' }}</td>
                        
                        <td class="text-center">
                            @if($item->status_verifikasi == 'pending')
                                <span class="badge badge-warning text-dark px-3 py-2">Menunggu PPID</span>
                            @elseif($item->status_verifikasi == 'publik') 
                                <span class="badge badge-success px-3 py-2">Arsip Publik</span>
                            @elseif($item->status_verifikasi == 'tidak_publik') 
                                <span class="badge badge-danger px-3 py-2">Arsip Unit</span>
                            @else
                                <span class="badge badge-secondary">{{ $item->status_verifikasi }}</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-info text-white" data-toggle="modal" data-target="#detailModal{{ $item->id }}" title="Lihat Detail Arsip">
                                <i class="fas fa-eye"></i>
                            </button>

                            @if(Auth::user()->role != 'manajemen')
                                <a href="{{ route('arsip.edit', $item->id) }}" class="btn btn-sm btn-primary" title="Edit Data">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <form action="{{ route('arsip.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus arsip ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            @endif
                            
                            <div class="modal fade text-left" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold text-primary" id="detailModalLabel{{ $item->id }}">Detail Arsip: {{ $item->judul }}</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body p-0">
                                            <table class="table table-bordered table-striped table-sm mb-0 text-left">
                                                <tbody>
                                                    <tr><th colspan="2" class="bg-light text-primary fw-bold px-3">DATA ARSIP</th></tr>
                                                    <tr><th width="35%" class="px-3">Judul</th><td class="px-3">{{ $item->judul }}</td></tr>
                                                    <tr><th class="px-3">Nomor Arsip</th><td class="px-3">{{ $item->nomor_arsip ?? $item->nomor ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Kode Klasifikasi</th><td class="px-3">{{ $item->kodeKlasifikasi->kode ?? '-' }} - {{ $item->kodeKlasifikasi->uraian ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Kategori</th><td class="px-3">{{ $item->kategori_berita ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Indeks</th><td class="px-3">{{ $item->indeks ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Uraian Informasi</th><td class="px-3">{{ $item->uraian_informasi ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Tanggal</th><td class="px-3">{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '-' }}</td></tr>
                                                    <tr><th class="px-3">Tingkat Perkembangan</th><td class="px-3">{{ $item->tingkat_perkembangan ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Jumlah</th><td class="px-3">{{ $item->jumlah ?? '-' }} {{ $item->satuan ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Unit Pengolah</th><td class="px-3">{{ $item->unitPengolah->nama_unit ?? '-' }}</td></tr>

                                                    <tr><th colspan="2" class="bg-light text-primary fw-bold px-3">LOKASI ARSIP</th></tr>
                                                    <tr><th class="px-3">Ruangan</th><td class="px-3">{{ $item->ruangan ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">No Box</th><td class="px-3">{{ $item->no_box ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">No Filling</th><td class="px-3">{{ $item->no_filling ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">No Laci</th><td class="px-3">{{ $item->no_laci ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">No Folder</th><td class="px-3">{{ $item->no_folder ?? '-' }}</td></tr>
                                                    <tr><th class="px-3">Keterangan</th><td class="px-3">{{ $item->keterangan ?? '-' }}</td></tr>

                                                    <tr><th colspan="2" class="bg-light text-primary fw-bold px-3">DOKUMEN & STATUS</th></tr>
                                                    <tr>
                                                        <th class="px-3">Status Verifikasi</th>
                                                        <td class="px-3">
                                                            @if($item->status_verifikasi == 'pending')
                                                                <span class="badge badge-warning text-dark">Menunggu PPID</span>
                                                            @elseif($item->status_verifikasi == 'publik')
                                                                <span class="badge badge-success">Arsip Publik</span>
                                                            @else
                                                                <span class="badge badge-danger">Arsip Unit Saja</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th class="px-3">Dokumen</th>
                                                        <td class="px-3">
                                                            @if($item->upload_dokumen)
                                                                @php
                                                                    $ekstensi = pathinfo($item->upload_dokumen, PATHINFO_EXTENSION);
                                                                @endphp

                                                                @if(in_array($ekstensi, ['pdf', 'jpg', 'jpeg', 'png']))
                                                                    <a href="{{ route('arsip.lihat', $item->id) }}" target="_blank" class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-file-pdf"></i> Lihat File Dokumen
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('arsip.lihat', $item->id) }}" class="btn btn-sm btn-success">
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
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="fas fa-folder-open mb-2" style="font-size: 24px;"></i><br>
                            Belum ada data arsip.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $arsip->links() }}
        </div>
    </div>
</main>
@endsection