<?php

namespace App\Http\Controllers;

use App\Models\DataPelanggan;
use App\Models\PesananModel;
use App\Models\PesananUserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data = PesananModel::with(['dataPelanggan','Status','Produk'])->get();
        $data = DataPelanggan::with(['ListPesanan', 'PesananUserPelanggan'])->get()->where('PesananUserPelanggan.status_pesanan', '===', null);
        // dd($data);
        return view('pages.pesanan.pesanan', [
            'data' => $data->toArray()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['tanggal_sekarang'] = date('Y-m-d H:i:s');

        $kode = mt_rand(1000000, 9999999);
        $kode_pesanan = 'ORD' . $kode;
        return view('pages.pesanan.tambahpesanan', [
            'data' => $data,
            'judul_form' => 'Tambah',
            'kode_pesanan' => $kode_pesanan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if (isset($data['bukti_tf']) && $data['bukti_tf'] != null) {
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
        }

        DB::beginTransaction();
        try {
            $pelanggan = $data['id'] == '' ? new DataPelanggan() : DataPelanggan::find($data['id']);
            $pelanggan->nama_pelanggan = $data['nama'];
            $pelanggan->nomor_hp = $data['no_hp'];
            $pelanggan->alamat = $data['alamat'];
            $pelanggan->save();

            // jika hasil dari PesananUserModel::where('kode_pesanan', $data['kode_pesanan'])->first() tidak ada datanya maka gunakan new PesananModel()
            $cek_pesanan_user = PesananUserModel::where('kode_pesanan', $data['kode_pesanan'])->first();
            if ($cek_pesanan_user == null) {
                $pesanan_user = new PesananUserModel();
            } else {
                $pesanan_user = PesananUserModel::where('kode_pesanan', $data['kode_pesanan'])->first();
            }
            $pesanan_user->kode_pesanan = $data['kode_pesanan'];
            $pesanan_user->pelanggan_id = $pelanggan->id;
            $pesanan_user->kode_resi = null;
            $pesanan_user->jasa_kurir = null;
            $pesanan_user->ongkir = null;
            $pesanan_user->status_pesanan = null;
            if (isset($data['bukti_tf']) && $data['bukti_tf'] != null) {
                $pesanan_user->bukti_tf = 'bukti_tf/' . $nama_file;
            }
            $pesanan_user->tanggal_pesan = $data['tanggal_pesanan'];
            $pesanan_user->total_harga_pesanan = $data['total'];
            $pesanan_user->save();

            if ($data['total'] == 0) {
                DB::commit();
                return redirect('/pesanan')->with('success', 'Pelanggan dan pesanan berhasil ditambahkan!');
            }
            // Menghapus pesanan yang ada jika ada
            PesananModel::where('pelanggan_id', $pelanggan->id)->delete();

            // Menambahkan pesanan baru
            foreach ($data['id_produk'] as $index => $id_produk) {
                PesananModel::create([
                    'produk_id' => $id_produk,
                    'kode_pesanan' => $data['kode_pesanan'],
                    'pelanggan_id' => $pelanggan->id,
                    'harga_produk' => $data['harga'][$index],
                    'qty' => $data['qty'][$index],
                    'tanggal_masuk' => $data['tanggal_pesanan'],
                    'total_pesanan' => $data['qty'][$index] * $data['harga'][$index],
                ]);
            }

            DB::commit();
            return redirect('/pesanan')->with('success', 'Pelanggan dan pesanan berhasil ditambahkan!');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
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
        $data = DataPelanggan::with(['ListPesanan', 'PesananUserPelanggan'])->find($id);

        if (!$data) {
            return redirect('/pesanan')->with('error', 'Data tidak ditemukan!');
        }

        $tanggal_pesan = PesananModel::where('pelanggan_id', $id)->first();
        $data->load(['ListPesanan.Produk', 'ListPesanan.Status', 'ListPesanan.Produk.JenisProduk']);

        // Menggunakan optional() untuk memastikan bahwa $tanggal_pesan tidak null
        $tanggal_masuk = optional($tanggal_pesan)->tanggal_masuk;

        return view('pages.pesanan.tambahpesanan', [
            'data' => $data->toArray(),
            'judul_form' => 'Edit',
            'tanggal_pesan' => $tanggal_masuk
        ]);
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
        $data = DataPelanggan::find($id);

        if (!$data) {
            return redirect('/pesanan')->with('error', 'Data tidak ditemukan!');
        }

        $data2 = PesananModel::where('pelanggan_id', $id)->get();
        if ($data2->isNotEmpty()) {
            // delete data2
            foreach ($data2 as $d) {
                $d->delete();
            }
        }

        $data3 = PesananUserModel::where('pelanggan_id', $id)->get();
        if ($data3->isNotEmpty()) {
            // delete data3
            foreach ($data3 as $d) {
                $d->delete();
            }
        }

        $data->delete();

        return redirect('/pesanan')->with('success', 'Data berhasil dihapus!');
    }

    public function listpesananowner(Request $request, string $id)
    {
        $data = DataPelanggan::with(['ListPesanan', 'PesananUserPelanggan'])->find($id);
        $data->load(['ListPesanan.Produk', 'ListPesanan.Status', 'ListPesanan.Produk.JenisProduk']);
        // dd($data->toArray());
        return view('pages.pesanan.listpesananowner', [
            'data' => $data->toArray()
        ]);
    }
}
