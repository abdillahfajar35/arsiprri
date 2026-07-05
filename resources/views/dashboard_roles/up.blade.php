@extends('template.main')

@section('content')
<style>
    .hover-scale { transition: transform 0.2s ease-in-out; }
    .hover-scale:hover { transform: scale(1.05); }
</style>

<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4" style="color: #103458;">Statistik Arsip SIPANDU</h5>

        <div class="row g-3">
            
            <div class="col-xl-3 col-md-6">
                <div class="border rounded text-center p-3 h-100 hover-scale" style="background-color: #f8f9fa;">
                    <div class="small text-secondary fw-bold mb-2">Total Arsip Unit</div>
                    <div class="h2 fw-bold mb-0" style="color: #103458;">{{ $totalArsipUnit }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="border rounded text-center p-3 h-100 hover-scale" style="background-color: #f8f9fa;">
                    <div class="small text-secondary fw-bold mb-2">Total Arsip PPID (Publik)</div>
                    <div class="h2 fw-bold mb-0" style="color: #103458;">{{ $totalPublik }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="border rounded text-center p-3 h-100 hover-scale" style="background-color: #f8f9fa;">
                    <div class="small text-secondary fw-bold mb-2">Total Arsip Belum Verif</div>
                    <div class="h2 fw-bold mb-0 text-danger">{{ $totalBelumVerif }}</div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6">
                <div class="border rounded text-center p-3 h-100 hover-scale" style="background-color: #f8f9fa;">
                    <div class="small text-secondary fw-bold mb-2">Total Arsip Sudah Verif</div>
                    <div class="h2 fw-bold mb-0 text-success">{{ $totalSudahVerif }}</div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- TAMBAHAN: Tabel Arsip Terbaru -->
<div class="card shadow-sm border-0 mb-4">
    <div class="card-body p-4">
        <h5 class="fw-bold mb-4" style="color: #103458;"><i class="fas fa-clock me-2"></i> 5 Arsip Terakhir Diunggah</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0">
                <thead style="background-color: #1c3b5a; color: white;">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Judul Arsip</th>
                        <th>Tanggal</th>
                        <th class="text-center">Status Verifikasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($arsipTerbaru as $index => $item)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('Y-m-d') : '-' }}</td>
                            <td class="text-center">
                                @if($item->status_verifikasi == 'pending')
                                    <span class="badge badge-warning text-dark">Menunggu PPID</span>
                                @elseif($item->status_verifikasi == 'publik')
                                    <span class="badge badge-success">Arsip Publik</span>
                                @else
                                    <span class="badge badge-danger">Arsip Unit</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada arsip yang diinput.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection