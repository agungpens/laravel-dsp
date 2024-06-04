@include('template.head')

<body class="horizontal light  ">
    <div class="wrapper">

        <nav class="navbar navbar-expand-lg navbar-light bg-white flex-row border-bottom shadow">
            <div class="container-fluid">
                <a class="navbar-brand mx-lg-1 mr-0" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logodsp.png') }}" alt="" width="110" height="50">
                </a>
                <span style="font-weight: bold; font-size: 15px;">Delta Subur Prima</span>
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item">
                        <a class="nav-link text-muted my-2" href="./#" id="modeSwitcher" data-mode="light">
                            <i class="fe fe-sun fe-16"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-11">
                        <div class="row align-items-center mb-2">
                            <div class="col">
                                <h2 class="h5 page-title">Informasi Pengiriman</h2>
                            </div>
                        </div>
                        <div class="card shadow ">
                            <div class="card-header">
                                <strong class="card-title">No. Pesanan: {{ $data['kode_pesanan'] }}</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-readonly">Nama</label>
                                            <input type="text" id="example-readonly" class="form-control"
                                                readonly="" value="{{ $data['user']['nama_pelanggan'] }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-readonly">No. Handphone</label>
                                            <input type="text" id="example-readonly" class="form-control"
                                                readonly="" value="{{ $data['user']['nomor_hp'] }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-static">Alamat</label>
                                            <textarea name="alamat" class="form-control" id="alamat" cols="30" rows="10" readonly>{{ $data['user']['alamat'] }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="example-readonly">Resi</label>
                                            <input type="text" id="example-readonly" class="form-control"
                                                readonly="" value="{{ $data['kode_resi'] }}">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="example-readonly">Kurir</label>
                                            <input type="text" id="example-readonly" class="form-control"
                                                readonly="" value="{{ $data['jasa_kurir'] }}">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div style="height: 30px;"></div>
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="h5 page-title">Rincian Pesanan</h2>
                            </div>
                        </div>
                        <div class="col-13">
                            <div class="card shadow">
                                <div class="card-body">
                                    <table class="table table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Produk</th>
                                                <th>Harga Produk</th>
                                                <th>Qty</th>
                                                <th>Total Harga Produk</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $totalHargaProduk = 0; // Inisialisasi variabel total harga produk
                                            @endphp
                                            @foreach ($data['list_pesanan_user'] as $item)
                                                <tr>
                                                    <td>{{ $item['produk']['nama_produk'] }}</td>
                                                    <td>{{ $item['produk']['harga'] }}</td>
                                                    <td>{{ $item['qty'] }}</td>
                                                    <td>{{ $item['total_pesanan'] }}</td>
                                                    <td>
                                                        @if ($data['status_pesanan'] == 0)
                                                            <span class="badge badge-danger">on hold</span>
                                                        @elseif ($data['status_pesanan'] == 1)
                                                            <span class="badge badge-warning">di proses</span>
                                                        @elseif ($data['status_pesanan'] == 2)
                                                            <span class="badge badge-success">di kirim</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @php
                                                    $totalHargaProduk += $item['total_pesanan']; // Menambahkan total harga produk
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h6>Subtotal Produk: Rp{{ number_format($totalHargaProduk, 0, ',', '.') }}</h6>
                                    <!-- Menampilkan total harga produk -->
                                    <h6>Subtotal Pengiriman: Rp{{ $data['ongkir'] }}</h6>
                                    <h6>Total Pembayaran:
                                        Rp{{ number_format($totalHargaProduk + $data['ongkir'], 0, ',', '.') }}</h6>
                                    <!-- Menghitung dan menampilkan total pembayaran -->

                                </div>
                            </div>
                        </div>
                    </div>
        </main>

    </div> <!-- .wrapper -->
    @include('template.script')
</body>

@if (session()->has('success'))
    <script>
        toastr.success(`{{ session('success') }}`);
    </script>
@endif
@if (session()->has('error'))
    <script>
        toastr.error(`{{ session('error') }}`);
        console.log(`{{ session('error') }}`);
    </script>
@endif
@if (count($errors) > 0)
    <script>
        toastr.error(`{{ $errors->first() }}`);
    </script>
@endif
