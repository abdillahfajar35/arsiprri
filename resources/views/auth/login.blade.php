<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login - Arsip LPP RRI Banjarmasin</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        
        <style>
            /* Sedikit animasi halus saat logo dimuat */
            .logo-animasi {
                animation: munculHalus 0.8s ease-in-out;
            }
            @keyframes munculHalus {
                0% { opacity: 0; transform: translateY(-15px); }
                100% { opacity: 1; transform: translateY(0); }
            }
        </style>
    </head>
    <body style="background-color: #1c3b5a;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content"> 
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5 mb-5">
                                    
                                    <div class="card-body p-4 p-md-5">
                                        
                                        <div class="text-center mb-4 logo-animasi">
                                            <img src="{{ asset('assets/img/rri-bjm-logo.png') }}" alt="Logo RRI Banjarmasin" class="img-fluid mb-4" style="max-width: 150px;">
                                            <h3 class="font-weight-bold text-dark mb-1">Selamat Datang</h3>
                                            <p class="text-muted mb-0">Silahkan masuk ke akun Anda</p>
                                        </div>

                                        <hr class="mb-4"> @if($errors->any())
                                            <div class="alert alert-danger font-weight-bold text-center">
                                                {{ $errors->first() }}
                                            </div>
                                        @endif

                                        <form action="{{ url('/login-proses') }}" method="POST" autocomplete="off">
                                            @csrf
                                            <div class="form-group mb-4">
                                                <label class="small font-weight-bold text-dark mb-2" for="inputEmailAddress">Email / Username</label>
                                                <input class="form-control py-4 shadow-none" id="inputEmailAddress" type="email" name="email" placeholder="Masukkan Email" autocomplete="off" required />
                                            </div>
                                            
                                            <div class="form-group mb-4">
                                                <label class="small font-weight-bold text-dark mb-2" for="inputPassword">Kata Sandi</label>
                                                <div class="input-group">
                                                    <input class="form-control py-4 border-right-0 shadow-none" id="inputPassword" type="password" name="password" placeholder="Kata Sandi" autocomplete="new-password" required />
                                                    <div class="input-group-append">
                                                        <button class="btn bg-white text-secondary border-left-0 shadow-none" type="button" id="btnViewPassword" style="border: 1px solid #ced4da; border-left: none; cursor: pointer;">
                                                            <i class="fas fa-eye"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="#">Lupa Kata Sandi?</a>
                                                <button type="submit" class="btn btn-primary px-4 py-2 font-weight-bold" style="background-color: #1c3b5a; border: none; border-radius: 6px;">
                                                    Login <i class="fas fa-sign-in-alt ml-2"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            
            {{--<div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">&copy; LPP RRI Banjarmasin 2026</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>--}}
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const passInput = document.getElementById('inputPassword');
                const btnView = document.getElementById('btnViewPassword');
                const iconView = btnView.querySelector('i');

                // Fungsi memunculkan password
                function showPass() {
                    passInput.type = 'text';
                    iconView.classList.remove('fa-eye');
                    iconView.classList.add('fa-eye-slash');
                    iconView.classList.add('text-primary'); // Icon jadi biru saat ditekan
                }

                // Fungsi menyembunyikan password
                function hidePass() {
                    passInput.type = 'password';
                    iconView.classList.remove('fa-eye-slash');
                    iconView.classList.add('fa-eye');
                    iconView.classList.remove('text-primary');
                }

                // UNTUK PENGGUNA LAPTOP/PC (MOUSE)
                btnView.addEventListener('mousedown', showPass);
                btnView.addEventListener('mouseup', hidePass);
                // Jaga-jaga kalau kursor ditarik menjauh sebelum mouse dilepas
                btnView.addEventListener('mouseleave', hidePass); 

                // UNTUK PENGGUNA HP/TABLET (LAYAR SENTUH)
                btnView.addEventListener('touchstart', function(e) {
                    e.preventDefault(); // Mencegah keyboard HP muncul
                    showPass();
                });
                btnView.addEventListener('touchend', hidePass);
                btnView.addEventListener('touchcancel', hidePass);
            });
        </script>
    </body>
</html>