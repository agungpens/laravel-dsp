<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanPenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggal_1_bulan_ini = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_hari_ini = date('Y-m-d');

        return view('pages.laporan_penjualan.index', [
            'tanggal_1_bulan_ini' => $tanggal_1_bulan_ini,
            'tanggal_hari_ini' => $tanggal_hari_ini,
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
