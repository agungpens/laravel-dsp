<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\PesananModel;
use App\Models\PesananUserModel;
use Illuminate\Http\Request;

class ListPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DataPelanggan::with(['ListPesanan', 'PesananUserPelanggan'])->get();
        $data = $data->where('PesananUserPelanggan.status_pesanan', '!==', null);

        $total_dikirim = $data->where('PesananUserPelanggan.status_pesanan', 2)->sum('PesananUserPelanggan.total_harga_pesanan');
        $total_diproses = $data->where('PesananUserPelanggan.status_pesanan', 1)->sum('PesananUserPelanggan.total_harga_pesanan');
        $total_semua = $data->where('PesananUserPelanggan.status_pesanan', '!=', 0)->sum('PesananUserPelanggan.total_harga_pesanan');
        $total_ditolak = $data->where('PesananUserPelanggan.status_pesanan', '===', 0)->sum('PesananUserPelanggan.total_harga_pesanan');


        // dd($data->toArray());
        return view('pages.pesanan.listpesanan', [
            'data' => $data->toArray(),
            'total_semua' => $total_semua,
            'total_dikirim' => $total_dikirim,
            'total_diproses' => $total_diproses,
            'total_ditolak' => $total_ditolak,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->post();
        $data_update = PesananUserModel::where('kode_pesanan', $id)->first();
        $data_update->status_pesanan = 2;
        $data_update->kode_resi = $data['kode_resi'];
        $data_update->jasa_kurir = $data['kurir'];
        $data_update->ongkir = $data['ongkir'];
        $data_update->save();

        return redirect('listpesanan')->with('success', 'Data berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
