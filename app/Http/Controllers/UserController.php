<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.setting');
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
        $data = $request->all();

        DB::beginTransaction();
        try {
            if (isset($data['username'])) {
                $push = User::find($id);
                $push->username = $data['username'];
                if (isset($data['password'])) {
                    if ($data['password'] != '' || $data['password'] != null) {
                        $push->password = bcrypt($data['password']);
                    }
                }
                $push->save();
                // commit
                DB::commit();

                return redirect()->back()->with('success', 'Data berhasil diupdate');
            }
            $push = User::find($id);
            if (isset($data['password'])) {
                if ($data['password'] != '' || $data['password'] != null) {
                    $push->password = bcrypt($data['password']);
                }
            }
            $push->save();
            // commit
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
        //
    }
}
