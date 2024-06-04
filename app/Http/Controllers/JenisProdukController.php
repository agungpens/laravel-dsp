<?php

namespace App\Http\Controllers;

use App\Models\JenisProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JenisProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = JenisProduk::all();

        return view('pages.jenis_produk.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['page_name'] = 'Tambah';
        return view('pages.jenis_produk.formadd', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $cek = DB::table('jenis_produks')->where('jenis_produk', $data['nama_jenis'])->get();
        if (count($cek) > 0) {
            return redirect()->back()->with('error', 'Jenis Produk sudah ada');
        }


        DB::beginTransaction();
        try {
            $push =  new JenisProduk();
            $push->jenis_produk = $data['nama_jenis'];
            $push->save();
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil disimpan');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal disimpan');
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
        $data = JenisProduk::find($id);
        $data['page_name'] = 'Edit';
        return view('pages.jenis_produk.formadd', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();

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
        DB::beginTransaction();
        try {
            JenisProduk::destroy($id);
            DB::commit();

            return redirect()->back()->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
    }
}
