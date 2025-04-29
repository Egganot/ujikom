<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand text-white d-flex align-items-center" href="{{ route('landing.index') }}">
            <img src="{{ asset('assets/img/Logo/Logo3.png') }}" alt="Logo" height="50" width="50">&emsp;
            <span class="logo-title fs-2">RUSHPOTIK</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon bg-light"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav mx-5 fs-4">
                @auth
                    @if (Auth::user()->role === 'superAdmin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin.index*') ? 'active' : '' }} text-white"
                                href="{{ route('admin.index') }}">
                                <i class="fas fa-home"></i> Transaksi
                            </a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link  {{ Request::is('landing.index*') ? 'active' : '' }} text-white"
                            href="{{ route('landing.index') }}">
                            <i class="fas fa-pills"></i> List Obat
                        </a>
                    </li>
                    @if (Auth::user()->role === 'superAdmin')
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('transaction*') ? 'active' : '' }} text-white"
                                href="{{ route('transaction.index') }}">
                                <i class="fas fa-cart-plus"></i> Transaksi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('apoteker*') ? 'active' : '' }} text-white"
                                href="{{ route('apoteker.index') }}">
                                <i class="fas fa-user-md"></i> Apoteker
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('supplier*') ? 'active' : '' }} text-white"
                                href="{{ route('supplier.index') }}">
                                <i class="fas fa-people-carry"></i> List Supplier
                            </a>
                        </li>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('customer*') ? 'active' : '' }} text-white"
                                href="{{ route('customer.index') }}">
                                <i class="fas fa-users"></i> List Pelanggan
                            </a>
                        </li>
                    @endif
                    @if (in_array(Auth::user()->role, ['admin', 'superAdmin']))
                        <li class="nav-item">
                            <a class="nav-link  {{ Request::is('report*') ? 'active' : '' }} text-white"
                                href="{{ route('report.index') }}">
                                <i class="fas fa-clipboard"></i> Laporan
                            </a>
                        </li>
                    @endif
                @endauth
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="{{ route('logout') }}"><i
                                class="fas fa-sign-out-alt"></i> Keluar</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="{{ route('login.index') }}"><i
                                class="fas fa-sign-in-alt"></i> Masuk</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
