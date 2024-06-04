<?php

namespace App\Http\Controllers;

use App\Models\PesananModel;
use App\Models\PesananUserModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggal_1_bulan_ini = date('Y-m-d', mktime(0, 0, 0, date('m'), 1, date('Y')));
        $tanggal_hari_ini = date('Y-m-d');

        // dd($data['total_pesanan']);
        return view('pages.dashboard', [
            'tanggal_1_bulan_ini' => $tanggal_1_bulan_ini,
            'tanggal_hari_ini' => $tanggal_hari_ini,
        ]);
    }
}
