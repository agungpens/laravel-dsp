<?php

namespace App\Http\Controllers;

use App\Models\PesananUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class cekPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.cek.cekpesanan');
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
    public function uploadbuktipembayaran(Request $request)
    {
        // Validasi request
        $validator = Validator::make($request->all(), [
            'bukti_tf' => 'required|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk gambar JPEG, PNG, JPG maksimum 2MB
        ]);

        // Jika validasi gagal, kembalikan respon dengan pesan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $dokumen = $request->file('bukti_tf');
        $nama_file = $dokumen->getClientOriginalName();
        $dokumen->move('bukti_tf/', $nama_file);

        // Jika penyimpanan berhasil, lakukan sesuatu seperti menyimpan path ke database, pesananUser where kode_pesanan
        $pesananUser = PesananUserModel::where('kode_pesanan', $request->input('kode_pesanan'))->first();
        $pesananUser->bukti_tf = 'bukti_tf/' . $nama_file;
        $pesananUser->save();
        // Jika penyimpanan gagal, kembalikan respon dengan pesan error
        if (!$pesananUser) {
            return redirect()->back()->with('error', 'Gagal mengunggah bukti pembayaran.');
        }
        // Redirect dengan pesan sukses jika berhasil
        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diunggah.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $kode_pesanan = $request->input('kode_pesanan');
        $data = PesananUserModel::with(['User', 'ListPesananUser'])->where('kode_pesanan', $kode_pesanan)->first();

        // Jika nilai dari $data tidak ada maka redirect
        if (empty($data)) {
            return redirect()->back()->with('error', 'Kode Pesanan Tidak Ditemukan');
        }

        $data->load(['ListPesananUser.Produk']);

        // Set pesan sukses ke dalam session dengan tag <br>
        $request->session()->flash('success', 'Selamat Datang, ' .  $data->user->nama_pelanggan . ' !');

        return view('pages.cek.detailpesanan', [
            'data' => $data->toArray()
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
