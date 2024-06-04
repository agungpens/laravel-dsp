@extends('template.main')

@section('content')
    <div class="col">
        <h2 class="h4 mb-1">Produk</h2>
        {{-- alert success & error --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('error') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card shadow">
            <div class="card-body">
                <div>
                    <a href="{{ url('produk/add') }}" class="btn btn-primary float-right ml-3">Tambah+</a>
                </div>
                <!-- table -->
                <table class="table table-bordered" id="tableproduk">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th>No</th>
                            <th>ID</th>
                            <th>Produk</th>
                            <th>Nama</th>
                            <th>Jenis</th>
                            <th>Harga</th>
                            <th>Qr Code</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->id }}</td>
                                <td>
                                    <img src="{{ asset('gambar_produk/' . $item->gambar_produk) }}" alt="produk1"
                                        width="70px">
                                </td>
                                <td>{{ $item->nama_produk }}</td>
                                <td>{{ $item->JenisProduk->jenis_produk ?? '' }}</td>

                                <td>Rp.{{ number_format($item->harga, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <center>
                                        {!! DNS2D::getBarcodeHTML($item->barcode, 'QRCODE', 3, 3) !!}
                                    </center>
                                    <br>
                                    {{-- {!! DNS1D::getBarcodeHTML($item->barcode, 'C39') !!}
                                    <br> --}}
                                    <a href="{{ url('download-barcode/' . $item->id) }}" class="btn btn-success btn-sm"
                                        id="downlaod-barcode">Download QR-Code</a>
                                </td>
                                <td>
                                    <button class="btn btn-sm more-horizontal" type="button">
                                        <span
                                            class="text-muted
                                        sr-only">Action</span>
                                        <a class="btn btn-sm" href="{{ url('produk/edit/' . $item->id) }}"><i
                                                class="fe fe-edit" style="font-size: 20px;"></i></a>
                                        <a class="btn btn-sm" href="{{ url('produk/delete/' . $item->id) }}"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus item ini?')"><i
                                                class="fe fe-trash-2" style="font-size: 20px;"></i></a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#tableproduk').DataTable();
        });
    </script>
@endsection
