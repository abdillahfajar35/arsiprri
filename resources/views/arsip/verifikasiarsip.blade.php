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
    <table class="table table-bordered bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Judul Arsip</th>
                <th>Nomor Arsip</th>
                <th>Tanggal</th>
                <th>Aksi Verifikasi (Keputusan)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arsip as $data)
            <tr>
                <td>{{ $data->judul }}</td>
                <td>{{ $data->nomor_arsip }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>
                    <form action="{{ route('arsip.verifikasi', $data->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menjadikan arsip ini Publik?');">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_verifikasi" value="publik">
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fas fa-check"></i> Jadikan Publik
                        </button>
                    </form>

                    <form action="{{ route('arsip.verifikasi', $data->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status_verifikasi" value="tidak_publik">
                        <button type="submit" class="btn btn-warning btn-sm">
                            <i class="fas fa-times"></i> Arsip Unit Saja
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-end mt-4 mb-2">
    {{ $arsip->links() }}
    </div>
</div>
@endsection