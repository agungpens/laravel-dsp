@extends('template.main')
@php
    $a = 1;
    $b = 1;
    $c = 1;
@endphp
@section('content')
    <div class="col">
        <h2 class="h4 mb-1">List Pesanan Produk</h2>
        <div class="card shadow">
            <div class="card-body">
                <!-- table -->
                <table class="table table-bordered" id="tablelistp">
                    <thead class="thead-dark">
                        <tr role="row">
                            <th>NO</th>
                            <th>Kode Pesanan</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>No. Telp</th>
                            <th>Alamat</th>
                            @if (auth()->user()->role == 2)
                                <th>Total(Rp.)</th>
                            @endif
                            <th>Status</th>
                            <th>Resi</th>
                            <th>KURIR</th>
                            @if (auth()->user()->role == 1)
                                <th>ONGKIR</th>
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    @if (auth()->user()->role == 2)
                        <tbody>
                            <tr role="group" class="bg-light">
                                <td colspan="11"><strong>DIPROSES</strong></td>
                            </tr>
                            @foreach ($data as $item)
                                @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                    <tr>
                                        <td>{{ $b++ }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                                        <td>{{ $item['nama_pelanggan'] }}</td>
                                        <td>{{ $item['nomor_hp'] }}</td>
                                        <td>{{ $item['alamat'] }}</td>
                                        <td>Rp. {{ $item['pesanan_user_pelanggan']['total_harga_pesanan'] }}</td>
                                        <td>
                                            @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                                <span class="badge badge-success">Dikirim</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_resi'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right"><b>Total</b></td>
                                <td class="bg-warning text-white"><b>Rp.{{ $total_diproses }}</b></td>
                                <td colspan="4"></td>
                            </tr>
                            <tr role="group" class="bg-light">
                                <td colspan="11"><strong>DIKIRIM</strong></td>
                            </tr>
                            @foreach ($data as $item)
                                @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                    <tr>
                                        <td>{{ $c++ }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                                        <td>{{ $item['nama_pelanggan'] }}</td>
                                        <td>{{ $item['nomor_hp'] }}</td>
                                        <td>{{ $item['alamat'] }}</td>
                                        <td>Rp. {{ $item['pesanan_user_pelanggan']['total_harga_pesanan'] }}</td>
                                        <td>
                                            @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                                <span class="badge badge-success">Dikirim</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_resi'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                            <tr>
                                <td colspan="6" class="text-right"><b>Total</b></td>
                                <td class="bg-success text-white"><b>Rp.{{ $total_dikirim }}</b></td>
                                <td colspan="4"></td>
                            </tr>


                            <tr role="group" class="bg-light">
                                <td colspan="11"><strong>DITOLAK</strong></td>
                            </tr>
                            @foreach ($data as $item)
                                @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                                        <td>{{ $item['nama_pelanggan'] }}</td>
                                        <td>{{ $item['nomor_hp'] }}</td>
                                        <td>{{ $item['alamat'] }}</td>
                                        <td>Rp. {{ $item['pesanan_user_pelanggan']['total_harga_pesanan'] }}</td>
                                        <td>
                                            @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                                <span class="badge badge-success">Dikirim</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_resi'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}</td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>

                        <tfoot>
                            {{-- buatkan total --}}
                            <tr>
                                <td colspan="6" class="text-right"><b>Total</b></td>
                                <td class="bg-success text-white"><b>Rp.{{ $total_semua }}</b></td>
                                <td colspan="4"></td>
                            </tr>
                        </tfoot>
                    @else
                        <tbody>
                            <tr role="group" class="bg-light">
                                <td colspan="11"><strong>DIPROSES</strong></td>
                            </tr>
                            @foreach ($data as $item)
                                @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                    <tr>
                                        <td>{{ $b++ }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                                        <td>{{ $item['nama_pelanggan'] }}</td>
                                        <td>{{ $item['nomor_hp'] }}</td>
                                        <td>{{ $item['alamat'] }}</td>
                                        <td>
                                            @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                                <span class="badge badge-success">Dikirim</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_resi'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['ongkir'] }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                data-target="#exampleModal{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}">Edit</button>
                                        </td>

                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade"
                                        id="exampleModal{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ url('updatelistpesanan/' . $item['pesanan_user_pelanggan']['kode_pesanan']) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group mb-3">
                                                            <label for="">KODE RESI</label>
                                                            <input type="text" class="form-control" name="kode_resi"
                                                                id="kode_resi"
                                                                value="{{ $item['pesanan_user_pelanggan']['kode_resi'] }}">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="">KURIR</label>
                                                            <input type="text" class="form-control" name="kurir"
                                                                id="kurir"
                                                                value="{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}">
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label for="">ONGKIR</label>
                                                            <input type="number" class="form-control" name="ongkir"
                                                                id="ongkir"
                                                                value="{{ $item['pesanan_user_pelanggan']['ongkir'] }}">
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <tr role="group" class="bg-light">
                                <td colspan="11"><strong>DIKIRIM</strong></td>
                            </tr>
                            @foreach ($data as $item)
                                @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                    <tr>
                                        <td>{{ $c++ }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                                        <td>{{ $item['nama_pelanggan'] }}</td>
                                        <td>{{ $item['nomor_hp'] }}</td>
                                        <td>{{ $item['alamat'] }}</td>
                                        <td>
                                            @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                                <span class="badge badge-success">Dikirim</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_resi'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['ongkir'] }}</td>

                                    </tr>
                                @endif
                                <!-- Modal -->
                                <div class="modal fade"
                                    id="exampleModal{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}" tabindex="-1"
                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form
                                                action="{{ url('updatelistpesanan/' . $item['pesanan_user_pelanggan']['kode_pesanan']) }}"
                                                method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-3">
                                                        <label for="">KODE RESI</label>
                                                        <input type="text" class="form-control" name="kode_resi"
                                                            id="kode_resi"
                                                            value="{{ $item['pesanan_user_pelanggan']['kode_resi'] }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">KURIR</label>
                                                        <input type="text" class="form-control" name="kurir"
                                                            id="kurir"
                                                            value="{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="">ONGKIR</label>
                                                        <input type="number" class="form-control" name="ongkir"
                                                            id="ongkir"
                                                            value="{{ $item['pesanan_user_pelanggan']['ongkir'] }}">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Update Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <tr role="group" class="bg-light">
                                <td colspan="11"><strong>DITOLAK</strong></td>
                            </tr>
                            @foreach ($data as $item)
                                @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                    <tr>
                                        <td>{{ $a++ }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                                        <td>{{ $item['nama_pelanggan'] }}</td>
                                        <td>{{ $item['nomor_hp'] }}</td>
                                        <td>{{ $item['alamat'] }}</td>
                                        <td>
                                            @if ($item['pesanan_user_pelanggan']['status_pesanan'] == 0)
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 1)
                                                <span class="badge badge-warning">Diproses</span>
                                            @elseif ($item['pesanan_user_pelanggan']['status_pesanan'] == 2)
                                                <span class="badge badge-success">Dikirim</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['pesanan_user_pelanggan']['kode_resi'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['jasa_kurir'] }}</td>
                                        <td>{{ $item['pesanan_user_pelanggan']['ongkir'] }}</td>
                                        <td></td>
                                    </tr>
                                @endif
                            @endforeach

                        </tbody>
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function() {
            $('#tablelistp').DataTable();
        });
    </script>
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
@endsection
