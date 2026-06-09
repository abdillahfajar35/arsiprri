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
    </head>
    <body style="background-color: #1c3b5a;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content"> 
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header text-center">
                                        <div class="text-center mb-3">
                                        <img src="{{ asset('assets/img/rri-bjm-logo.png') }}" alt="Logo Instansi" style="max-width: 160px;">
                                        </div>

                                        <h3 class="font-bold-light mt-4 mb-1">Selamat Datang</h3>
                                        <p class="text-muted mb-4">Silahkan masuk ke akun Anda</p></div>
                                    <div class="card-body">
                                        @if($errors->any())
                                             <div class="alert alert-danger">
                                              {{ $errors->first() }}
                                         </div>
                                        @endif
                                        <form action="{{ url('/login-proses') }}" method="POST" autocomplete="off">
                                            @csrf
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" name="email" placeholder="Masukkan Email" autocomplete="off" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Kata Sandi</label>
                                                <input class="form-control py-4" id="inputPassword" type="password" name="password" placeholder="Kata Sandi" autocomplete="new-password" />
                                            </div>
                                            <div class="form-group">
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-end mt-4 mb-0">
                                                <button type="submit" class="btn btn-primary" style="background-color: #1c3b5a;">Login</button>
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
                            </div>--}}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{ asset('js/scripts.js') }}"></script>
    </body>
</html>