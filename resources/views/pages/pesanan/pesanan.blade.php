@extends('template.main')
@section('content')
<div class="col">
    <h2 class="h4 mb-1">Data Pesanan Masuk</h2>
    <div class="card shadow">
        <div class="card-body">
            <div>
                @if (auth()->user()->role == 1)
                <a href="{{ url('tambahpesanan') }}" class="btn btn-primary float-right ml-3">Tambah+</a>
                @endif
            </div>
            <!-- table -->
            <table class="table table-bordered" id="tablepesanan">
                <thead class="thead-dark">
                    <tr role="row">
                        <th>NO</th>
                        <th>KODE PESANAN</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>No. Telp</th>
                        <th>Alamat</th>
                        @if (auth()->user()->role == 2)
                        <th>Order</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($data != null)
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @if ($item['pesanan_user_pelanggan'] != null)
                        <td>{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}</td>
                        <td>{{ $item['pesanan_user_pelanggan']['tanggal_pesan'] }}</td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                        <td>{{ $item['nama_pelanggan'] }}</td>
                        <td>{{ $item['nomor_hp'] }}</td>
                        <td>{{ $item['alamat'] }}</td>
                        @if (auth()->user()->role == 2)
                        <td>
                            <a href="{{ url('listpesananowner/' . $item['id']) }}" class="btn btn-primary">
                                Detail Order
                            </a>
                        </td>
                        @endif
                        <td>
                            @if (auth()->user()->role == 1)
                            <a href="{{ url('editpesanan/' . $item['id']) }}" class="btn btn-warning mb-1">
                                <i class="fe fe-edit" style="font-size: 20px;"></i>
                            </a>
                            <a href="{{ url('hapuspesanan/' . $item['id']) }}" class="btn btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="fe fe-trash" style="font-size: 20px;"></i>
                            </a>
                            @elseif (auth()->user()->role == 2)
                            @if ($item['pesanan_user_pelanggan'] != null)
                            <select class="form-control" name="update_status" id="update_status"
                                kode_pesanan="{{ $item['pesanan_user_pelanggan']['kode_pesanan'] }}"
                                onchange="Pesanan.updateStatusDropdown(this)">
                                <option value="">Pilih Status</option>
                                <option value="0" {{ $item['pesanan_user_pelanggan']['status_pesanan']==0 &&
                                    $item['pesanan_user_pelanggan']['status_pesanan'] !=null ? 'selected' : '' }}>
                                    DITOLAK</option>
                                <option value="1" {{ $item['pesanan_user_pelanggan']['status_pesanan']==1 ? 'selected'
                                    : '' }}>
                                    DIPROSES</option>
                                <option value="2" {{ $item['pesanan_user_pelanggan']['status_pesanan']==2 ? 'selected'
                                    : '' }}>
                                    DIKIRIM</option>
                            </select>
                            @endif
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    let Pesanan = {
            updateStatusDropdown: (elm) => {
                let status = $(elm).val();
                let kode_pesanan = $(elm).attr('kode_pesanan');
                Pesanan.updateStatus(kode_pesanan, status);
            },
            updateStatus: (kode_pesanan, status) => {
                $.ajax({
                    url: `{{ route('updatestatuspesanan') }}`,
                    type: 'POST',
                    data: {
                        kode_pesanan: kode_pesanan,
                        status: status
                    },
                    success: function(res) {
                        toastr.success('Berhasil mengubah status pesanan');
                    },
                    error: function(err) {
                        toastr.error('Gagal mengubah status pesanan');
                    }
                });
            }
        }



        $(function() {
            $('#tablepesanan').DataTable();
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
</script>
@endif
@if (count($errors) > 0)
<script>
    toastr.error(`{{ $errors->first() }}`);
</script>
@endif
@endsection
