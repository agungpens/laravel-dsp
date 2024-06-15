@extends('template.main')

@section('content')
<div class="row mb-3">
    <div class="col-12">
        <h2 class="h4 mb-1">Laporan Penjualan</h2>
    </div>
</div>
<div class="col-12">
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="h5 mb-1">Filter Laporan</h4>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="dari">Dari</label>
                        <input type="date" class="form-control" id="dari" value="{{ $tanggal_1_bulan_ini }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="sampai">Sampai</label>
                        <input type="date" class="form-control" id="sampai" value="{{ $tanggal_hari_ini }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="kode_pesanan">Kode Pesanan</label>
                        <input type="text" class="form-control" id="kode_pesanan" value="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" value="">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-primary" id="cari" onclick="Laporan.getData()"> <i
                            class="fas fa-search"></i>
                        Cari</button>
                </div>
            </div>

            <hr>
            <div class="row">
                {{-- Judul Form Filter --}}
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="h5 mb-1">Table Laporan</h4>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="btn btn-warning float-right mb-3" id="export-pdf"
                        onclick="Laporan.cetak_pdf()"> <i class="fas fa-print"></i> Export PDF</button>
                    <table class="table table-bordered" id="laporan-penjualan">
                        <thead class="thead-dark">
                            <tr role="row">
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Kode Pesanan</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th>Jumlah(qty)</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('script')
<script>
    let Laporan = {
        getData: () => {
            let dari = $('#dari').val();
            let sampai = $('#sampai').val();
            let kode_pesanan = $('#kode_pesanan').val();
            let nama_produk = $('#nama_produk').val();
            $.ajax({
                url: "{{ route('getData.laporan.penjualan') }}",
                type: 'POST',
                data: {
                    dari: dari,
                    sampai: sampai,
                    kode_pesanan: kode_pesanan,
                    nama_produk: nama_produk
                },
                success: function(response) {
                    let html = '';
                    let total = 0;
                    let total_ditolak = 0;

                    // Convert response.data_dikirim to an array
                    const dataDikirimValues = Object.values(response.data_dikirim);

                    dataDikirimValues.forEach((item, index) => {
                        html += `
                                <tr>
                                    <td rowspan="${Array.isArray(item.list_pesanan_user) ? item.list_pesanan_user.length : 1}">${index + 1}</td>
                                    <td rowspan="${Array.isArray(item.list_pesanan_user) ? item.list_pesanan_user.length : 1}">${item.tanggal_pesan}</td>
                                    <td rowspan="${Array.isArray(item.list_pesanan_user) ? item.list_pesanan_user.length : 1}">${item.kode_pesanan}</td>
                                    <td rowspan="${Array.isArray(item.list_pesanan_user) ? item.list_pesanan_user.length : 1}">${item.user.nama_pelanggan}</td>
                                    <td rowspan="${Array.isArray(item.list_pesanan_user) ? item.list_pesanan_user.length : 1}">${item.user.alamat}</td>
                                        `;

                        if (Array.isArray(item.list_pesanan_user)) {
                            item.list_pesanan_user.forEach((items, indexs) => {
                                if (indexs !== 0) {
                                    html += '<tr>';
                                }
                                html += `
                                                <td>${items.produk.nama_produk}</td>
                                                <td>Rp.${items.harga_produk}</td>
                                                <td>${items.qty}</td>
                                                <td>Rp. ${items.total_pesanan}</td>
                                            `;
                                if (indexs !== 0) {
                                    html += '</tr>';
                                }
                                total += parseInt(items.total_pesanan);
                            });
                        } else if (typeof item.list_pesanan_user === 'object') {
                            html += `
                                                <td>${item.list_pesanan_user.produk.nama_produk}</td>
                                                <td>${item.list_pesanan_user.harga_produk}</td>
                                                <td>${item.list_pesanan_user.qty}</td>
                                                <td>Rp. ${item.list_pesanan_user.total_pesanan}</td>
                                            `;
                            total += parseInt(item.list_pesanan_user.total_pesanan);
                        }

                        html += `</tr>`;
                    });

                    html += `
                    <tr>
                                <th colspan="8" class="text-right">Total</th>
                                <th class="text-right" id="total_semua">Rp. 0</th>
                    </tr>
                    `;



                    // Update table body
                    $('#laporan-penjualan tbody').html(html);

                    // Update table footer
                    $('#total_semua').html(`Rp. ${total}`);
                    $('#total_ditolak').html(`Rp. ${total_ditolak}`);

                    // Initialize DataTable
                    $('#laporan-penjualan').DataTable();
                }
            });
        },

        cetak_pdf: () => {
                let dari = $('#dari').val();
                let sampai = $('#sampai').val();
                let kode_pesanan = $('#kode_pesanan').val();
                let nama_produk = $('#nama_produk').val();

                Swal.fire({
                    title: "Anda akan mengunduh?",
                    text: `Apakah Anda akan mengunduh laporan tanggal ${dari} sampai ${sampai}?`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, tetap unduh!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send Ajax request to download PDF
                        $.ajax({
                            url: "{{ route('cetak_pdf') }}",
                            type: 'POST',
                            data: {
                                dari: dari,
                                sampai: sampai,
                                kode_pesanan: kode_pesanan,
                                nama_produk: nama_produk
                            },
                            success: function(response) {
                                // No need to handle file download manually here
                                // Success message can be shown if needed
                                Swal.fire({
                                    title: "Terunduh!",
                                    text: "Laporan telah berhasil diunduh.",
                                    icon: "success"
                                });
                            }
                        });
                    }
                });
        }

    }

        $(function() {
            Laporan.getData();


        });
</script>
@endsection
