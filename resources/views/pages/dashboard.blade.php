@extends('template.main')

@section('content')
<div class="row align-items-center mb-2">
    <div class="col-6">
        <form class="form-inline">
            <div class="form-group d-none d-lg-inline">
                <div class=" text-muted">
                    {{ $tanggal_hari_ini }}
                    <span class="small"></span>
                </div>
            </div>
        </form>
    </div>
    <div class="col-6">
        <h2 class="h5 float-right">Selamat Datang {{ auth()->user()->username }}!</h2>

    </div>
    <div class="col-6">
    </div>

</div>

<div class="row">
    <div class="col">
        <label for="tanggal_awal">Tanggal awal</label>
        <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal"
            value="{{ $tanggal_1_bulan_ini }}">
    </div>
    <div class="col">
        <label for="tanggal_akhir">Tanggal akhir</label>
        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" value="{{ $tanggal_hari_ini }}">
    </div>
    <div class="col mt-auto">
        <button type="button" class="btn btn-success" onclick="Dashboard.getData()"> Filter</button>
    </div>
</div>
<br>
<div class="row">
    <div class="col-12">
        <div class="" id="container"></div>
    </div>
</div>

@endsection




@section('script')
<script>
    let Dashboard = {
            getData: () => {
                let tanggal_awal = $('#tanggal_awal').val();
                let tanggal_akhir = $('#tanggal_akhir').val();
                $.ajax({
                    url: "{{ route('laporan.penjualan') }}",
                    type: "POST",
                    data: {
                        tanggal_awal: tanggal_awal,
                        tanggal_akhir: tanggal_akhir
                    },
                    success: function(data) {
                        Dashboard.chart1(data);
                    }
                });
            },

            chart1: (data) => {
                // Create the chart
                let seriesData = [{
                        name: 'Pesanan Dikirim',
                        y: data.pesanan_dikirim,
                        color: '#9EDE73' // Warna untuk pesanan dikirim
                    },
                    {
                        name: 'Pesanan Diproses',
                        y: data.pesanan_diproses,
                        color: 'orange' // Warna untuk pesanan diproses
                    },
                    {
                        name: 'Pesanan Ditolak',
                        y: data.pesanan_ditolak,
                        color: 'red' // Warna untuk pesanan ditolak
                    },
                ];

                Highcharts.chart('container', {
                    chart: {
                        type: 'column'
                    },
                    title: {
                        align: 'left',
                        text: 'Chart Pesanan'
                    },
                    subtitle: {
                        align: 'left',
                        text: `periode tanggal  ${data.tanggal_awal} sampai ${data.tanggal_akhir}`
                    },
                    accessibility: {
                        announceNewData: {
                            enabled: true
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: ''
                        }

                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            borderWidth: 0,
                            dataLabels: {
                                enabled: true,
                                format: '{point.y:.0f}'
                            }
                        }
                    },

                    tooltip: {
                        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
                    },

                    series: [{
                        name: 'Browsers',
                        colorByPoint: true,
                        data: seriesData // Gunakan data yang diterima untuk series data
                    }],

                });
            }

        }


        $(function() {
            Dashboard.getData();
        });
</script>
@endsection

