<div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" style="background-color: #0d1f30;">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Selamat Datang</div>
                            <a class="nav-link" href="{{ url('/dashboard') }}">
                                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                                Dashboard
                            </a>
                            @if(auth()->user()->role == 'up')
                    <a class="nav-link" href="{{ url('/inputarsip') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-file-import"></i></div>
                        Input Arsip
                    </a>
                    <a class="nav-link" href="{{ route('arsip.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Daftar Arsip
                    </a>
                @endif

                @if(auth()->user()->role == 'ppid')
                    <a class="nav-link" href="{{ url('/verifikasiarsip') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-shield-alt"></i></div>
                        Verifikasi Arsip
                        <span class="badge bg-warning text-dark ms-auto fw-bold"></span>
                    </a>
                    <a class="nav-link" href="{{ route('arsip.publik') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Daftar Arsip Publik
                    </a>
                @endif

                @if(auth()->user()->role == 'manajemen')
                    <a class="nav-link" href="{{ url('/daftararsip') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Daftar Arsip Unit
                    </a>
                    <a class="nav-link" href="{{ route('arsip.publik') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-folder-open"></i></div>
                        Daftar Arsip Publik
                    </a>
                @endif

                </div>
        </div>