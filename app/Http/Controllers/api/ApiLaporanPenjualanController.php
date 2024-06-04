<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\PesananModel;
use App\Models\PesananUserModel;
use App\Models\Produk;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiLaporanPenjualanController extends Controller
{
    public function getData(Request $request)
    {
        $data = $request->all();
        $tanggalAwal = date('Y-m-d 00:00:00', strtotime($data['dari'])); // Konversi ke format tanggal dan waktu awal hari
        $tanggalAkhir = date('Y-m-d 23:59:59', strtotime($data['sampai'])); // Konversi ke format tanggal dan waktu akhir hari

        $data['data'] = PesananUserModel::with([
            'User',
            'ListPesananUser',
            'ListPesananUser.Produk',
            'ListPesananUser.Status',
            'ListPesananUser.Produk.JenisProduk'
        ]);
        $data['data_dikirim'] = $data['data']->whereBetween('tanggal_pesan', [$tanggalAwal, $tanggalAkhir])->get()->where('status_pesanan', 2);
        $data['data_ditolak'] = $data['data']->whereBetween('tanggal_pesan', [$tanggalAwal, $tanggalAkhir])->get()->where('status_pesanan', 0)->whereNotNull('status_pesanan');



        return response()->json($data);
    }



    public function cetak_pdf(Request $request)
    {
        $data = $request->all();
        $tanggalAwal = date('Y-m-d 00:00:00', strtotime($data['dari']));
        $tanggalAkhir = date('Y-m-d 23:59:59', strtotime($data['sampai']));


        $data['data'] = PesananUserModel::with([
            'User',
            'ListPesananUser',
            'ListPesananUser.Produk',
            'ListPesananUser.Status',
            'ListPesananUser.Produk.JenisProduk'
        ])->whereBetween('tanggal_pesan', [$tanggalAwal, $tanggalAkhir])->get();

        $data['data_dikirim'] = $data['data']->where('status_pesanan', 2);
        $data['total_harga_dikirim'] = $data['data_dikirim']->sum('total_harga_pesanan');

        $data['data_ditolak'] = $data['data']->where('status_pesanan', 0)->whereNotNull('status_pesanan');
        $data['total_harga_ditolak'] = $data['data_ditolak']->sum('total_harga_pesanan');


        $pdf = PDF::loadView('pages.laporan_penjualan.laporan_pdf', [
            'data' => $data,
            'tanggalAwal' => date("Y-m-d", strtotime($tanggalAwal)),
            'tanggalAkhir' => date("Y-m-d", strtotime($tanggalAkhir)),
        ]);
        return $pdf->stream();
    }
}
