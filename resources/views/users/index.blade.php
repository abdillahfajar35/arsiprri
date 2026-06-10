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
                                @elseif($user->role == 'up') 
                                    <span class="badge badge-secondary">Unit Pengolah</span>
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
                                                        <div class="input-group">
                                                            @php $usernameOnly = str_replace('@rri.co.id', '', $user->email); @endphp
                                                            
                                                            <input type="text" id="username_edit_{{ $user->id }}" class="form-control shadow-none" value="{{ $usernameOnly }}" placeholder="Ketik username..." style="border-right: none;" required>
                                                            <div class="input-group-append">
                                                                <span class="input-group-text bg-white text-muted font-weight-bold" style="border-left: none; pointer-events: none;">@rri.co.id</span>
                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="email" id="email_asli_edit_{{ $user->id }}" value="{{ $user->email }}">
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
                                                        <label>Password Baru <span class="text-danger small">(Kosongkan jika tidak ingin ganti)</span></label>
                                                        <div class="input-group">
                                                            <input type="password" name="password" id="password_edit_{{ $user->id }}" class="form-control password-cek" placeholder="Ketik password baru...">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_edit_{{ $user->id }}', this)">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small class="text-danger font-weight-bold d-none error_panjang_pass">* Password minimal 6 karakter!</small>
                                                    </div>
                                                    
                                                    <div class="form-group mb-3">
                                                        <label>Konfirmasi Password Baru</label>
                                                        <div class="input-group">
                                                            <input type="password" name="password_confirmation" id="konfirmasi_edit_{{ $user->id }}" class="form-control" placeholder="Ketik ulang password baru...">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('konfirmasi_edit_{{ $user->id }}', this)">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <small class="text-danger font-weight-bold error-text mt-1" style="display: none;"></small>
                                                    </div>

                                                </div> 
                                                <div class="modal-footer">
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

<div class="modal fade text-left" id="modalTambah" tabindex="-1" aria-hidden="true">
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
                        <div class="input-group">
                            <input type="text" id="username_tambah" class="form-control shadow-none" placeholder="Ketik username..." style="border-right: none;" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-white text-muted font-weight-bold" style="border-left: none; pointer-events: none;">@rri.co.id</span>
                            </div>
                        </div>
                        <input type="hidden" name="email" id="email_asli_tambah">
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
                        <div class="input-group">
                            <input type="password" name="password" id="password_tambah" class="form-control password-cek" placeholder="Ketik password..." required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_tambah', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-danger font-weight-bold d-none error_panjang_pass">* Password minimal 6 karakter!</small>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label>Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" name="password_confirmation" id="konfirmasi_tambah" class="form-control" placeholder="Ketik ulang password..." required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('konfirmasi_tambah', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <small class="text-danger font-weight-bold error-text mt-1" style="display: none;"></small>
                    </div>

                </div> 
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // 1. FUNGSI UNTUK TOMBOL VIEW PASSWORD (MATA)
    function togglePassword(inputId, button) {
        let input = document.getElementById(inputId);
        let icon = button.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash'); // Ganti icon mata dicoret
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye'); // Kembalikan icon mata normal
        }
    }

    // 2. DETEKSI PASSWORD KURANG DARI 6 KARAKTER (REAL-TIME)
    document.addEventListener('DOMContentLoaded', function() {
        let passInputs = document.querySelectorAll('.password-cek');
        
        passInputs.forEach(function(input) {
            input.addEventListener('input', function() {
                let parentGroup = this.closest('.form-group');
                let errorTeks = parentGroup.querySelector('.error_panjang_pass');
                
                // Jika sudah ada ketikan tapi kurang dari 6 huruf
                if (this.value.length > 0 && this.value.length < 6) {
                    this.classList.add('is-invalid');
                    if(errorTeks) errorTeks.classList.remove('d-none'); // Munculkan teks merah
                } else {
                    this.classList.remove('is-invalid');
                    if(errorTeks) errorTeks.classList.add('d-none'); // Sembunyikan teks merah
                }
            });
        });
    });

    // 3. SATPAM UTAMA SAAT TOMBOL SIMPAN DIKLIK
    function cekPassword(form, event) {
        
        // GABUNGKAN USERNAME + @RRI.CO.ID
        // Mengambil input username spesifik dari form yang sedang di-submit
        let inputUsername = form.querySelector('[id^="username_"]'); 
        let inputEmailAsli = form.querySelector('[id^="email_asli_"]');
        
        if (inputUsername && inputEmailAsli) {
            inputEmailAsli.value = inputUsername.value + '@rri.co.id';
        }

        // AMBIL NILAI PASSWORD
        let inputPassword = form.querySelector('input[name="password"]');
        let inputKonfirmasi = form.querySelector('input[name="password_confirmation"]');
        let pesanError = form.querySelector('.error-text');

        if (inputPassword && inputKonfirmasi && pesanError) {
            let nilaiPassword = inputPassword.value;
            let nilaiKonfirmasi = inputKonfirmasi.value;

            // Reset/Sembunyikan pesan error bawah
            pesanError.style.display = 'none';
            pesanError.innerText = '';

            // CEK 1: Password diisi tapi kurang dari 6 karakter
            if (nilaiPassword !== "" && nilaiPassword.length < 6) {
                pesanError.innerText = "* Password baru tidak valid (Minimal 6 Karakter)!";
                pesanError.style.display = 'block'; 
                inputPassword.focus();
                event.preventDefault(); 
                return false;
            }

            // CEK 2: Konfirmasi kosong
            if (nilaiPassword !== "" && nilaiKonfirmasi === "") {
                pesanError.innerText = "* Harap isi kolom Konfirmasi Password!";
                pesanError.style.display = 'block'; 
                inputKonfirmasi.focus();
                event.preventDefault(); 
                return false;
            }

            // CEK 3: Typo / tidak sama
            if (nilaiPassword !== nilaiKonfirmasi) {
                pesanError.innerText = "* Password dan Konfirmasi Password tidak sama!";
                pesanError.style.display = 'block'; 
                inputKonfirmasi.focus();
                event.preventDefault(); 
                return false;
            }
        }
        
        return true; 
    }
</script>
@endsection