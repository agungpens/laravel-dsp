<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\DataPelanggan;
use App\Models\PesananModel;
use App\Models\PesananUserModel;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiDashboardController extends Controller
{
    public function getData(Request $request)
    {
        $data = $request->all();

        $tanggalAwal = date('Y-m-d 00:00:00', strtotime($data['tanggal_awal'])); // Konversi ke format tanggal dan waktu awal hari
        $tanggalAkhir = date('Y-m-d 23:59:59', strtotime($data['tanggal_akhir'])); // Konversi ke format tanggal dan waktu akhir hari

        $data['data'] = PesananUserModel::whereBetween('tanggal_pesan', [$tanggalAwal, $tanggalAkhir]);
        $data['data'] = $data['data']->get();

        $data['pesanan_dikirim'] = $data['data']->where('status_pesanan', 2)->count();
        $data['pesanan_ditolak'] = $data['data']->where('status_pesanan', 0)->count();
        $data['pesanan_diproses'] = $data['data']->where('status_pesanan', 1)->count();


        return response()->json($data);
    }
}
