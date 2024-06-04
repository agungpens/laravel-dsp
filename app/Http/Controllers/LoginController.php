<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.login');
    }

    public function authentication(Request $request)
    {

        $data = $request->all();

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);


        $userdata = DB::table('users as usr')
            ->select(['usr.*'])
            ->where('usr.username', '=', $data['username'])
            ->first();

        if ($userdata == null) {
            return redirect()->route('login')->with('error', 'Username tidak ditemukan');
        }

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('dashboard')->with('success', 'Selamat datang ' . session('nama'));
        }

        return back()->withErrors([
            'username' => 'Username anda salah!!',
            'password' => 'Password anda salah!!',
        ]);
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil Logout');
    }

    public function registrasi()
    {
        return view('pages.registrasi');
    }
    public function signup(Request $request)
    {
        $data = $request->all();
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // jika ada data username / password yang sama di table user maka kembalikan url dan berikan alert
        $cek = DB::table('users')->where('username', $data['username'])->get();
        if (count($cek) > 0) {
            return redirect()->back()->with('error', 'Username sudah ada');
        }


        DB::beginTransaction();
        try {
            $push =  new User();
            $push->username = $data['username'];
            $push->password = bcrypt($data['password']);
            $push->role = 1;
            $push->save();
            DB::commit();

            return redirect()->route('login')->with('success', 'Akun berhasil dibuat');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Akun gagal dibuat');
        }
    }

    public function loginMobile(Request $request)
    {
        $result['is_valid'] = false;

        try {

            $loginData = $request->validate([
                'username' => 'required',
                'password' => 'required'
            ]);

            // cek apakah ada datanya tidak di model User
            $user = User::where('username', $loginData['username'])->first();
            if (!$user) {
                $result['message'] = "Username tidak ditemukan";
                $result['is_valid'] = false;
                return response()->json($result);
            }

            // cek apakah passwordnya sama
            if (!Auth::attempt($loginData)) {
                $result['message'] = "Password salah";
                $result['is_valid'] = false;
                return response()->json($result);
            }

            $token = Auth::user()->createToken('authToken')->plainTextToken;


            $result['data'] = Auth::user();
            $result['token'] = $token;



            $result['is_valid'] = true;
        } catch (\Throwable $th) {
            $result['message'] = $th->getMessage();
        }

        return response()->json($result);
    }
}
