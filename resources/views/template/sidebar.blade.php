<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex brand">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ url('dashboard') }}">
                <img src="{{ asset('assets/images/logodsp.png') }}" alt="" width="100" height="50">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item  @if (Request::is('dashboard')) active @endif ">
                <a href="{{ url('dashboard') }}" class="nav-link @if (Request::is('dashboard')) text-primary @endif">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text ">Dashboard</span>
                </a>
            </li>
        </ul>

        <p class=" nav-heading mt-4 mb-1">
            <span>Pencatatan</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item  @if (Request::is('pesanan')) active @endif ">
                <a href="{{ url('pesanan') }}" class="nav-link @if (Request::is('pesanan')) text-primary @endif">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="ml-3 item-text ">Pesanan Masuk</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item  @if (Request::is('listpesanan')) active @endif ">
                <a href="{{ url('listpesanan') }}"
                    class="nav-link @if (Request::is('listpesanan')) text-primary @endif">
                    <i class="fe fe-file-text fe-16"></i>
                    <span class="ml-3 item-text ">List Pesanan</span>
                </a>
            </li>
        </ul>
        @if (auth()->user()->role == 2)
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item  @if (Request::is('laporan-penjualan')) active @endif ">
                    <a href="{{ url('laporan-penjualan') }}"
                        class="nav-link @if (Request::is('laporan-penjualan')) text-primary @endif">
                        <i class="fe fe-file-text fe-16"></i>
                        <span class="ml-3 item-text ">Laporan Penjualan</span>
                    </a>
                </li>
            </ul>
        @endif
        @if (auth()->user()->role == 1)
            <p class=" nav-heading mt-4 mb-1">
                <span>Produk</span>
            </p>
            <ul class="navbar-nav flex-fill w-100 mb-2">
                <li class="nav-item  @if (Request::is('produk')) active @endif ">
                    <a href="{{ url('produk') }}"
                        class="nav-link @if (Request::is('produk')) text-primary @endif">
                        <i class="fe fe-file-text fe-16"></i>
                        <span class="ml-3 item-text ">Data Produk</span>
                    </a>
                </li>
                <li class="nav-item  @if (Request::is('jenis_produk')) active @endif ">
                    <a href="{{ url('jenis_produk') }}"
                        class="nav-link @if (Request::is('jenis_produk')) text-primary @endif">
                        <i class="fe fe-file-text fe-16"></i>
                        <span class="ml-3 item-text ">Jenis Produk</span>
                    </a>
                </li>
            </ul>
        @endif
    </nav>
</aside>

@section('script')
@endsection
