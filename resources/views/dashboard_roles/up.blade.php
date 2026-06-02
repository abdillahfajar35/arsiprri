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
@endsection