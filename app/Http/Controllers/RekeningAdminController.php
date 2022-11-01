<?php

namespace App\Http\Controllers;

use App\Models\RekeningAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RekeningAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(request()->all(), [
            'rekening_admin' => 'required',
            'name_rekening_admin' => 'required',
            'name_bank_admin' => 'required',
            'full_name_bank_admin' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $bank = RekeningAdmin::create([
            'rekening_admin' => request('rekening_admin'),
            'name_rekening_admin' => request('name_rekening_admin'),
            'name_bank_admin' => request('name_bank_admin'),
            'full_name_bank_admin' => request('full_name_bank_admin')
        ]);
        if ($bank) {
            return response()->json([
                'success' => true,
                'message' => 'Rekening Admin Berhasil Disimpan',
                'data' => $bank
            ]);
        } else {
            return response()->json(['message' => 'Rekening Admin Gagal Disimpan']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
