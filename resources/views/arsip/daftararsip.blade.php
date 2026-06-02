@extends('template.main')

@section('content')

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
                    <div class="modal fade text-start" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold text-primary" id="detailModalLabel{{ $item->id }}">Detail Arsip Unit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-bordered table-sm text-left">
                                        <tbody>
                                            <tr><th width="35%" class="bg-light">Judul</th><td>{{ $item->judul }}</td></tr>
                                            <tr><th class="bg-light">Nomor Arsip</th><td>{{ $item->nomor_arsip ?? '-' }}</td></tr>
                                            <tr><th class="bg-light">Kategori</th><td>{{ $item->kategori_berita ?? '-' }}</td></tr>
                                            <tr><th class="bg-light">Uraian Informasi</th><td>{{ $item->uraian_informasi ?? '-' }}</td></tr>
                                            <tr><th class="bg-light">Tingkat Perkembangan</th><td>{{ $item->tingkat_perkembangan ?? '-' }}</td></tr>
                                            <tr><th class="bg-light">Tanggal</th><td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '-' }}</td></tr>
                                            <tr><th class="bg-light">Unit Pengolah</th><td>{{ $item->unitPengolah->nama_unit ?? '-' }}</td></tr>
                                            <tr>
                                                <th class="bg-light">Status Verifikasi</th>
                                                <td>
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
                                                <th class="bg-light">Dokumen</th>
                                                <td>
                                                    @if($item->upload_dokumen)
                                                        @php
                                                            $ekstensi = pathinfo($item->upload_dokumen, PATHINFO_EXTENSION);
                                                    @endphp

                                                    @if(in_array($ekstensi, ['pdf', 'jpg', 'jpeg', 'png']))
                                                        <a href="{{ route('arsip.lihat', $item->id) }}" target="_blank">
                                                            <i class="fas fa-file-pdf"></i> Lihat File Dokumen
                                                        </a>
                                                    @else
                                                         <a href="{{ route('arsip.lihat', $item->id) }}" class="text-primary font-weight-bold" style="text-decoration: underline;">
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
@endsection