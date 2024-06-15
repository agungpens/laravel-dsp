<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;

use App\Models\PesananUserModel;

use PDF;
use Illuminate\Http\Request;


class ApiLaporanPenjualanController extends Controller
{
    public function getData(Request $request)
    {
        $data = $request->all();
        $tanggalAwal = date('Y-m-d 00:00:00', strtotime($data['dari'])); // Konversi ke format tanggal dan waktu awal hari
        $tanggalAkhir = date('Y-m-d 23:59:59', strtotime($data['sampai'])); // Konversi ke format tanggal dan waktu akhir hari

        // Ambil data dengan relasi yang diperlukan
        $query = PesananUserModel::with([
            'User',
            'ListPesananUser',
            'ListPesananUser.Produk',
            'ListPesananUser.Status',
            'ListPesananUser.Produk.JenisProduk'
        ]);

        // Tambahkan filter tanggal
        $query->whereBetween('tanggal_pesan', [$tanggalAwal, $tanggalAkhir]);

        // Tambahkan filter LIKE untuk nama_produk jika tersedia
        if (!empty($data['nama_produk'])) {
            $query->whereHas('ListPesananUser.Produk', function ($q) use ($data) {
                $q->where('nama_produk', 'like', '%' . $data['nama_produk'] . '%');
            });
        }
        if (!empty($data['kode_pesanan'])) {
            $query->where('kode_pesanan',$data['kode_pesanan']);
        }

        // Dapatkan data_dikirim dengan status_pesanan 2
        $data['data_dikirim'] = $query->where('status_pesanan', 2)->get();

        // Dapatkan data_ditolak dengan status_pesanan 0
        $data['data_ditolak'] = $query->where('status_pesanan', 0)->whereNotNull('status_pesanan')->get();

        return response()->json($data);
    }




    public function cetak_pdf(Request $request)
    {
        $data = $request->all();
        $tanggalAwal = date('Y-m-d 00:00:00', strtotime($data['dari']));
        $tanggalAkhir = date('Y-m-d 23:59:59', strtotime($data['sampai']));

        $query = PesananUserModel::with([
            'User',
            'ListPesananUser',
            'ListPesananUser.Produk',
            'ListPesananUser.Status',
            'ListPesananUser.Produk.JenisProduk'
        ])->whereBetween('tanggal_pesan', [$tanggalAwal, $tanggalAkhir]);

        if (!empty($data['kode_pesanan'])) {
            $query->where('kode_pesanan', $data['kode_pesanan']);
        }

        if (!empty($data['nama_produk'])) {
            $query->whereHas('ListPesananUser.Produk', function ($q) use ($data) {
                $q->where('nama_produk', 'like', '%' . $data['nama_produk'] . '%');
            });
        }

        $data['data'] = $query->get();

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
