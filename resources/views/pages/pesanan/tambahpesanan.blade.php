@extends('template.main')

@section('content')
<div class="col">
    <h2 class="h4 mb-1">{{ $judul_form }} Pesanan Masuk</h2>
    <div class="card shadow">
        <form action="{{ url('tambahpesanan/submit') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="mb-3"> DATA USER </label>
                        <div class="form-group mb-3">
                            <label for="tanggal">Tanggal</label>
                            <input type="datetime-local" id="tanggal" name="tanggal_pesanan" class="form-control"
                                value="{{ $judul_form == 'Edit' ? $data['pesanan_user_pelanggan']['tanggal_pesan'] : $data['tanggal_sekarang'] }}"
                                readonly required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="nama">Nama</label>
                            <input type="hidden" id="id" class="form-control" name="id"
                                value="{{ $judul_form == 'Tambah' ? '' : $data['id'] }}">
                            <input type="text" id="nama" class="form-control" name="nama"
                                value="{{ $judul_form == 'Tambah' ? '' : $data['nama_pelanggan'] }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="no_hp">No. Handphone</label>
                            <input type="text" id="no_hp" class="form-control" name="no_hp"
                                value="{{ $judul_form == 'Tambah' ? '' : $data['nomor_hp'] }}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="example-static">Alamat Pengiriman</label>
                            <textarea name="alamat" class="form-control" id="alamat" cols="55" rows="10"
                                required>{{ $judul_form == 'Tambah' ? '' : $data['alamat'] }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <label for="" class="mb-3"> DATA PESANAN USER </label>
                        <div class="col-12">
                            <div class="col-6">
                                <div class="form-group mb-3">
                                    <label for="kode_pesanan">Kode Pesanan</label>
                                    <input type="text" id="kode_pesanan" name="kode_pesanan" class="form-control"
                                        value="{{ $judul_form == 'Edit' ? $data['pesanan_user_pelanggan']['kode_pesanan'] : $kode_pesanan }}"
                                        readonly>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <button type="button" id="pilihProduk" onclick="Pesanan.showDataProduk(this, event)"
                                class="btn btn-primary float-right mb-3">Pilih
                                Produk</button>
                            <table id="table-produk" class="table table-bordered" id="tableproduk">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Nama Produk</th>
                                        <th>Jenis</th>
                                        <th>Harga</th>
                                        <th>QTY</th>
                                        <th style="width: 10px">ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($judul_form == 'Edit' && $data['list_pesanan'] != '')
                                    @foreach ($data['list_pesanan'] as $item)
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id_produk[]" value="{{ $item['produk_id'] }}">
                                            <input type="text" class="form-control" name="nama_produk[]"
                                                value="{{ $item['produk']['nama_produk'] }}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="jenis[]"
                                                value="{{ $item['produk']['jenis_produk']['jenis_produk'] }}" readonly>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="harga[]"
                                                value="{{ $item['harga_produk'] }}" readonly>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" name="qty[]"
                                                onChange="Pesanan.gantiQty(this)" value="{{ $item['qty'] }}">
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger"
                                                onclick="Pesanan.hapusDataProduk(this)">Hapus</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    {{-- buatkan total --}}
                                    <tr>
                                        <td colspan="2">Total (Rp.)</td>
                                        <td>
                                            <input type="text" class="form-control" name="total" id="total" value=""
                                                readonly>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            @if ($judul_form == 'Edit')
                            <div class="form-group mb-3">
                                <label for="example-readonly">Status Pembayaran :</label>
                                @if ($data['pesanan_user_pelanggan']['bukti_tf'] == null)
                                <span class="badge badge-danger">belum dibayar</span>
                                <input type="hidden" name="kode_pesanan"
                                    value="{{ $data['pesanan_user_pelanggan']['kode_pesanan'] }}">
                                <input type="file" name="bukti_tf" id="bukti_tf" class="form-control">
                                @else
                                <span class="badge badge-success">sudah dibayar</span>
                                <br>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">
                                    Lihat Bukti
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Butki
                                                    Pembayaran</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="{{ asset($data['pesanan_user_pelanggan']['bukti_tf']) }}"
                                                    alt="bukti pembayaran" class="img-fluid">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <br>
                                <label for="example-readonly">Upload Ulang :</label>
                                <input type="hidden" name="kode_pesanan"
                                    value="{{ $data['pesanan_user_pelanggan']['kode_pesanan'] }}">
                                <input type="file" name="bukti_tf" id="bukti_tf" class="form-control">
                                @endif
                            </div>
                            @elseif ($judul_form == 'Tambah')
                            <input type="hidden" name="bukti_tf" id="bukti_tf" class="form-control">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ url('pesanan') }}" class="btn mb-2 btn-outline-danger mx-2">Batal</a>
                    <button type="submit" class="btn mb-2 btn bg-success-darker text-white">
                        Simpan<span class="fe fe-chevron-right ml-2"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')

<script src="https://cdn.socket.io/4.7.5/socket.io.min.js"
    integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO" crossorigin="anonymous">
</script>
<script>
    $(function() {
    let ip_address = '127.0.0.1';
    let socket_port = '1234';

    let socket = io(ip_address + ':' + socket_port);

    let jenis = ''
    let id_produk= ''
    let harga= ''
    let nama_produk= ''

    socket.on('receive-data', function (data) {

    $.each(data, function (indexInArray, valueOfElement) {



    let table = $("table#table-produk");


        jenis = valueOfElement['jenis_produk']['jenis_produk'];
        id_produk = valueOfElement['id'];
        harga = valueOfElement['harga'];
        nama_produk = valueOfElement['nama_produk'];


                let tr = `
                <tr>
                    <td>
                        <input type="hidden" name="id_produk[]" value="${id_produk}">
                        <input type="text" class="form-control" name="nama_produk[]" value="${nama_produk}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jenis[]" value="${jenis}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="harga[]" value="${harga}" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="qty[]" onChange="Pesanan.gantiQty(this)" value="1" >
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="Pesanan.hapusDataProduk(this)">Hapus</button>
                    </td>
                </tr>
                `;
                table.find("tbody").append(tr);

                // hapus data produk


                // hitung total
                let total = 0;
                $("table#table-produk tbody tr").each(function() {
                    let harga = $(this).find("input[name='harga[]']").val();
                    let qty = $(this).find("input[name='qty[]']").val();
                    total += parseInt(harga) * parseInt(qty);
                });
                $("input[name='total']").val(total);

    });
    // return console.log(data['message']);
    // Display the received data in the messages div

    });


            $('#tableku').DataTable();
            $('#tableku2').DataTable();
        });


        let Pesanan = {
            showDataProduk: (elm) => {
                let params = {};

                $.ajax({
                    type: "POST",
                    dataType: "html",
                    data: params,
                    url: '{{ route('showDataProduk') }}',

                    success: function(resp) {

                        bootbox.dialog({
                            message: resp,
                            size: "large",
                        });
                        Pesanan.getDataProduk();
                    },
                    error: function() {
                        toastr.error("Terjadi Kesalahan");
                    },
                });
            },

            getDataProduk: async () => {
                let tableData = $("table#table-data");
                if (tableData.length > 0) {
                    tableData.DataTable({
                        processing: true,
                        serverSide: true,
                        ordering: true,
                        autoWidth: false,
                        order: [
                            [0, "desc"]
                        ],
                        aLengthMenu: [
                            [25, 50, 100],
                            [25, 50, 100],
                        ],
                        ajax: {
                            url: '{{ route('getDataProduk') }}',
                            type: "POST",
                            // "headers": {
                            //     'X-CSRF-TOKEN': `'${tokenApi}'`
                            // }
                        },
                        deferRender: true,
                        createdRow: function(row, data, dataIndex) {
                            // console.log('row', $(row));
                        },
                        columnDefs: [{
                                targets: 4,
                                orderable: false,
                                createdCell: function(
                                    td,
                                    cellData,
                                    rowData,
                                    row,
                                    col
                                ) {
                                    $(td).addClass("td-padd");
                                },
                            },
                            {
                                targets: 2,
                                orderable: true,
                                createdCell: function(
                                    td,
                                    cellData,
                                    rowData,
                                    row,
                                    col
                                ) {
                                    // $(td).addClass('td-padd');
                                },
                            },
                            {
                                targets: 1,
                                orderable: false,
                                createdCell: function(
                                    td,
                                    cellData,
                                    rowData,
                                    row,
                                    col
                                ) {
                                    $(td).addClass("td-padd");
                                    $(td).addClass("text-center");
                                },
                            },
                            {
                                targets: 0,
                                createdCell: function(
                                    td,
                                    cellData,
                                    rowData,
                                    row,
                                    col
                                ) {
                                    // $(td).addClass('td-padd');
                                },
                            },
                        ],
                        columns: [{
                                data: "id",
                                render: function(data, type, row, meta) {
                                    return meta.row + meta.settings._iDisplayStart + 1;
                                },
                            },
                            {
                                data: "id",
                                render: (data, type, row, meta) => {
                                    return `
                                    <i class="fas fa-pencil" style = "cursor: pointer;" nama_produk = "${row.nama_produk}" id_produk = "${data}" jenis = "${row.jenis_produk.jenis_produk}" harga="${row.harga}"  onclick = "Pesanan.pilihDataProduk(this)" ></i>
                                    `;
                                },
                            },
                            {
                                data: "nama_produk",
                            },

                            {
                                data: "id",
                                render: (data, type, row, meta) => {
                                    return `
                            ${row.jenis_produk.jenis_produk}
                            `;
                                },

                            },
                            {
                                data: "harga",
                            },
                        ],
                    });
                }
            },

            pilihDataProduk: (elm) => {
                let jenis = $(elm).attr("jenis");
                let id_produk = $(elm).attr("id_produk");
                let harga = $(elm).attr("harga");
                let nama_produk = $(elm).attr("nama_produk");

                // close botbox
                bootbox.hideAll();
                // masukan kedalam table
                let table = $("table#table-produk");
                let tr = `
                <tr>
                    <td>
                        <input type="hidden" name="id_produk[]" value="${id_produk}">
                        <input type="text" class="form-control" name="nama_produk[]" value="${nama_produk}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="jenis[]" value="${jenis}" readonly>
                    </td>
                    <td>
                        <input type="text" class="form-control" name="harga[]" value="${harga}" readonly>
                    </td>
                    <td>
                        <input type="number" class="form-control" name="qty[]" onChange="Pesanan.gantiQty(this)" value="1" >
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" onclick="Pesanan.hapusDataProduk(this)">Hapus</button>
                    </td>
                </tr>
                `;
                table.find("tbody").append(tr);

                // hapus data produk
                $(elm).remove();

                // hitung total
                let total = 0;
                $("table#table-produk tbody tr").each(function() {
                    let harga = $(this).find("input[name='harga[]']").val();
                    let qty = $(this).find("input[name='qty[]']").val();
                    total += parseInt(harga) * parseInt(qty);
                });
                $("input[name='total']").val(total);

            },

            hapusDataProduk: (elm) => {
                $(elm).closest("tr").remove();
                Pesanan.hitungTotal();
            },

            // gantiQty
            gantiQty: (elm) => {
                let qty = $(elm).val();
                let harga = $(elm).closest("tr").find("input[name='harga[]']").val();
                let total = parseInt(qty) * parseInt(harga);
                $(elm).closest("tr").find("input[name='total[]']").val(total);

                // hitung total
                let totalAll = 0;
                $("table#table-produk tbody tr").each(function() {
                    let harga = $(this).find("input[name='harga[]']").val();
                    let qty = $(this).find("input[name='qty[]']").val();
                    totalAll += parseInt(harga) * parseInt(qty);
                });
                $("input[name='total']").val(totalAll);
            },

            hitungTotal: () => {
                let total = 0;
                $('input[name="qty[]"]').each(function() {
                    let qty = $(this).val();
                    let harga = $(this).closest('tr').find('input[name="harga[]"]').val();
                    let subtotal = parseInt(qty) * parseInt(harga);
                    total += subtotal;
                });
                $('#total').val(total); // Menampilkan total dengan 2 angka desimal
            }
        }

        // init
        Pesanan.hitungTotal();
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
