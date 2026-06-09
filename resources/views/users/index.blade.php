@extends('template.main')

@section('content')
<main class="p-3 p-md-4">
    <div class="bg-white p-4 rounded shadow-sm mb-4">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="fw-bold m-0" style="color:#003B69;">
                <i class="fas fa-users me-2"></i> Manajemen Akun Pengguna
            </h3>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Akun
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger shadow-sm">
                <strong>Gagal menyimpan data karena:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="bg-light">
                    <tr>
                        <th width="5%" class="text-center">No</th>
                        <th>Nama Pengguna</th>
                        <th>Email / Username</th>
                        <th>Hak Akses (Role)</th>
                        <th>Unit Pengolah</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $index => $user)
                        <tr>
                            <td class="text-center">{{ $users->firstItem() + $index }}</td>
                            <td class="font-weight-bold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if($user->role == 'ppid') 
                                    <span class="badge badge-success">PPID</span>
                                @elseif($user->role == 'manajemen') 
                                    <span class="badge badge-info">Manajemen</span>
                                @elseif($user->role == 'up') <span class="badge badge-secondary">Unit Pengolah</span>
                                @else 
                                    <span class="badge badge-dark">{{ $user->role }}</span>
                                @endif
                            </td>
                            <td>{{ $user->unitPengolah->nama_unit ?? '-' }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalEdit{{ $user->id }}" title="Edit Data & Password">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus akun ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Hapus Akun">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                                <div class="modal fade text-left" id="modalEdit{{ $user->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title fw-bold">Edit Akun: {{ $user->name }}</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <form action="{{ route('users.update', $user->id) }}" method="POST" onsubmit="return cekPassword(this, event)">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label>Nama Pengguna</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Email / Username</label>
                                                        <input type="text" name="email" class="form-control" value="{{ $user->email }}" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Role</label>
                                                        <select name="role" class="form-control" required>
                                                            <option value="up" {{ $user->role == 'up' ? 'selected' : '' }}>Unit Pengolah</option>
                                                            <option value="ppid" {{ $user->role == 'ppid' ? 'selected' : '' }}>PPID</option>
                                                            <option value="manajemen" {{ $user->role == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Asal Unit Pengolah (Kosongkan jika bukan UP)</label>
                                                        <select name="unit_pengolah_id" class="form-control">
                                                            <option value="">-- Bukan Unit Pengolah --</option>
                                                            @foreach($unitPengolah as $up)
                                                                <option value="{{ $up->id }}" {{ $user->unit_pengolah_id == $up->id ? 'selected' : '' }}>{{ $up->nama_unit }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Password Baru <span class="text-danger small">(Kosongkan jika tidak ingin ganti password)</span></label>
                                                        <input type="password" name="password" class="form-control" placeholder="Ketik password baru...">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label>Konfirmasi Password Baru</label>
                                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ketik ulang password baru...">
                                                         <small class="text-danger font-weight-bold error-text mt-1" style="display: none;"></small>
                                                    </div>
                                                </div> <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Belum ada data pengguna.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end mt-3">
            {{ $users->links() }}
        </div>
    </div>
</main>

<div class="modal fade" id="modalTambah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambah Akun Baru</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form action="{{ route('users.store') }}" method="POST" onsubmit="return cekPassword(this, event)">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label>Nama Pengguna</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Email / Username</label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Role</label>
                        <select name="role" class="form-control" required>
                            <option value="up">Unit Pengolah</option>
                            <option value="ppid">PPID</option>
                            <option value="manajemen">Manajemen</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Asal Unit Pengolah (Kosongkan jika bukan UP)</label>
                        <select name="unit_pengolah_id" class="form-control">
                            <option value="">-- Pilih Unit Pengolah --</option>
                            @foreach($unitPengolah as $up)
                                <option value="{{ $up->id }}">{{ $up->nama_unit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label>Password Akun</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        <small class="text-danger font-weight-bold error-text mt-1" style="display: none;"></small>
                    </div>
                </div> <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function cekPassword(form, event) {
        let inputPassword = form.querySelector('input[name="password"]');
        let inputKonfirmasi = form.querySelector('input[name="password_confirmation"]');
        
        // Cari elemen tempat error ditampilkan
        let pesanError = form.querySelector('.error-text');

        if (inputPassword && inputKonfirmasi && pesanError) {
            let nilaiPassword = inputPassword.value;
            let nilaiKonfirmasi = inputKonfirmasi.value;

            // Reset/Sembunyikan pesan error setiap kali tombol diklik ulang
            pesanError.style.display = 'none';
            pesanError.innerText = '';

            // KONDISI 1: Konfirmasi kosong
            if (nilaiPassword !== "" && nilaiKonfirmasi === "") {
                pesanError.innerText = "* Harap isi kolom Konfirmasi Password!";
                pesanError.style.display = 'block'; // Tampilkan pesan merah!
                inputKonfirmasi.focus();
                event.preventDefault(); // Rem mendadak!
                return false;
            }

            // KONDISI 2: Typo / tidak sama
            if (nilaiPassword !== nilaiKonfirmasi) {
                pesanError.innerText = "* Password dan Konfirmasi Password tidak sama!";
                pesanError.style.display = 'block'; // Tampilkan pesan merah!
                inputKonfirmasi.focus();
                event.preventDefault(); // Rem mendadak!
                return false;
            }
        }
        
        // JIKA AMAN: Biarkan tombol submit meluncur ke server
        return true; 
    }
</script>
@endsection