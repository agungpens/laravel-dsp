<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Milon\Barcode\DNS2D;
use Dompdf\Dompdf;
use Dompdf\Options;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Produk::with('JenisProduk')->get();
        // dd($data->toArray());
        return view('pages.produk.produk', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['jenis_produk'] = JenisProduk::all();
        $data['page_name'] = 'Tambah';
        return view('pages.produk.tambahproduk', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pesan = [
            'required' => 'attribute wajib diisi',
            'mimes' => 'File harus berupa file png,jpg,jpeg',
        ];

        $this->validate($request, [
            'nama_produk' => 'required',
            'jenis_produk' => 'required',
            'harga' => 'required',
            'gambar_produk' => 'mimes:png,jpg,jpeg',
        ], $pesan);

        if ($request->id == null) {
            // buatkan kode random untuk barcode
            $kode = mt_rand(100000, 999999);

            $dokumen = $request->file('gambar_produk');
            $nama_file = $dokumen->getClientOriginalName();
            $dokumen->move('gambar_produk/', $nama_file);


            produk::create([
                'jenis_produk_id' => $request->jenis_produk,
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'barcode' => 'PRD-' . $kode,
                'gambar_produk' => $nama_file,
            ]);
            return redirect('/produk')->with(['success' => 'Data Berhasil Ditambahkan']);
        } else {
            $data = $request->all();
            // update data
            $produk = Produk::find($request->id);
            $produk->jenis_produk_id = $data['jenis_produk'];
            $produk->nama_produk = $data['nama_produk'];
            $produk->harga = $data['harga'];
            // validasi gambar
            if ($request->file('gambar_produk') != null) {
                // hapus gambar lama
                $file = public_path('gambar_produk/' . $produk->gambar_produk);
                if (file_exists($file)) {
                    unlink($file);
                }
                // upload gambar baru
                $dokumen = $request->file('gambar_produk');
                $nama_file = $dokumen->getClientOriginalName();
                $dokumen->move('gambar_produk/', $nama_file);
                $produk->gambar_produk = $nama_file;
            }
            $produk->save();
            return redirect('/produk')->with(['success' => 'Data Berhasil Diupdate']);
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
        $data = Produk::find($id);
        $data['jenis_produk'] = JenisProduk::all();
        $data['page_name'] = 'Edit';
        return view('pages.produk.tambahproduk', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        dd($data);
        DB::beginTransaction();
        try {
            $push =  JenisProduk::find($id);
            $push->jenis_produk = $data['nama_jenis'];
            $push->save();
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil diupdate');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $produk = Produk::find($id);
        $file = public_path('gambar_produk/' . $produk->gambar_produk);
        $file_barcode = public_path('barcode/' . $produk->barcode . '.png');
        if (file_exists($file_barcode)) {
            unlink($file_barcode);
        }

        if (file_exists($file)) {
            unlink($file);
        }
        $produk->delete();
        return redirect('/produk')->with(['success' => 'Data Berhasil Dihapus']);
    }
    public function printBarcode(String $id)
    {
        // Membuat objek barcode
        $barcode = new DNS2D();

        // Mendapatkan produk berdasarkan ID
        $produk = Produk::find($id);
        if (!$produk) {
            // Handle jika produk tidak ditemukan
            return response()->json(['message' => 'Produk tidak ditemukan'], 404);
        }

        // Mendapatkan data barcode dalam format PNG base64
        $barcodeData = $barcode->getBarcodePNG($produk->barcode, "QRCODE");

        // Simpan gambar barcode sebagai file PNG
        $fileName = public_path('barcode/' . $produk->barcode . '.png');
        file_put_contents($fileName, base64_decode($barcodeData));

        // Mengembalikan response untuk mendownload gambar PNG
        return response()->download($fileName);
    }
}
