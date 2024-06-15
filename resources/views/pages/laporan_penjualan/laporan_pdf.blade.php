<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: "Gill Sans", sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f7f7f7; */
            font-size: 12px;
        }

        /* Container for centering content */
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        h2,
        h3 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            padding: 8px;
            position: relative;
            text-align: left;
            /* Changed to left alignment */
        }

        th {
            /* background-color: #f2f2f2; */
            font-weight: bold;
        }

        tfoot th {
            /* background-color: #e0e0e0; */
        }

        /* Style for horizontal lines */
        td:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 1px;
            /* background-color: #ddd; */
            /* Adjust the color as needed */
        }

        /* Hide horizontal line for the last row */
        tbody tr:last-child td:before {
            display: none;
        }

        #total_semua,
        #total_ditolak {
            font-weight: bold;
            text-align: left;
        }

        @media only screen and (max-width: 600px) {
            table {
                font-size: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Laporan Penjualan Delta Subur Prima</h2>
        <h3>Periode : {{ $tanggalAwal }} - {{ $tanggalAkhir }}</h3>
        <table id="laporan-penjualan">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Kode Pesanan</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Produk</th>
                    <th>Harga</th>
                    <th>Jumlah (qty)</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data['data_dikirim']->toArray() as $key => $item)
                <tr>
                    <td rowspan="{{ count($item['list_pesanan_user']) }}">{{ $key + 1 }}</td>
                    <td rowspan="{{ count($item['list_pesanan_user']) }}">{{ $item['tanggal_pesan'] }}</td>
                    <td rowspan="{{ count($item['list_pesanan_user']) }}">{{ $item['kode_pesanan'] }}</td>
                    <td rowspan="{{ count($item['list_pesanan_user']) }}">{{ $item['user']['nama_pelanggan'] }}</td>
                    <td rowspan="{{ count($item['list_pesanan_user']) }}">{{ $item['user']['alamat'] }}</td>
                    @foreach ($item['list_pesanan_user'] as $index => $value)
                    @if ($index !== 0)
                <tr>
                    @endif
                    <td>{{ $value['produk']['nama_produk'] }}</td>
                    <td>Rp. {{ number_format($value['produk']['harga'], 0, ',', '.') }}</td>
                    <td>{{ $value['qty'] }}</td>
                    <td>Rp. {{ number_format($value['total_pesanan'], 0, ',', '.') }}</td>
                    @if ($index === 0)
                </tr>
                @endif
                @endforeach
                </tr>
                @endforeach
                <tr>
                    <th colspan="7" style="text-align: right;">Total</th>
                    <th id="total_semua">Rp. {{ number_format($data['total_harga_dikirim'], 0, ',', '.') }}</th>
                    <th></th>
                </tr>
            </tbody>

        </table>
    </div>
</body>

</html>
