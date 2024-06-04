<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\PesananModel;
use App\Models\PesananUserModel;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiPesananController extends Controller
{
    public function getDataProduk()
    {

        DB::enableQueryLog();
        $data['data'] = [];
        $data['recordsTotal'] = 0;
        $data['recordsFiltered'] = 0;
        $datadb =  Produk::with('JenisProduk');

        // dd($datadb->get());
        if (isset($_POST)) {
            $data['recordsTotal'] = $datadb->get()->count();
            if (isset($_POST['search']['value'])) {
                $keyword = $_POST['search']['value'];
                $datadb->where(function ($query) use ($keyword) {
                    $query->where('nama_produk', 'LIKE', '%' . $keyword . '%');
                });
            }

            $data['recordsFiltered'] = $datadb->get()->count();

            if (isset($_POST['length'])) {
                $datadb->limit($_POST['length']);
            }
            if (isset($_POST['start'])) {
                $datadb->offset($_POST['start']);
            }
        }
        $data['data'] = $datadb->get()->toArray();
        // dd($data['data']);
        $data['draw'] = $_POST['draw'];
        $query = DB::getQueryLog();

        return response()->json($data);
    }
    public function showDataProduk(Request $request)
    {
        $data = $request->all();
        return view('pages.pesanan.dataProduk', $data);
    }

    public function updatestatuspesanan(Request $request)
    {
        $data = $request->post();
        $data['status'];
        $data_update = PesananUserModel::where('kode_pesanan', $data['kode_pesanan'])->first();
        // update status
        $data_update->status_pesanan = $data['status'];
        $data_update->save();
        return response()->json($data_update);
    }
}
