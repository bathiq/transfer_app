<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BankController extends Controller
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
            'bank_name' => 'required',
            'bank_full_name' => 'required',
            'bank_code' => 'required',
            'bank_account_name' => 'required',
            'bank_account_rekening' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }
        $bank = Bank::create([
            'bank_name' => request('bank_name'),
            'bank_full_name' => request('bank_full_name'),
            'bank_code' => request('bank_code'),
            'bank_account_name' => request('bank_account_name'),
            'bank_account_rekening' => request('bank_account_rekening'),
        ]);
        if ($bank) {
            return response()->json([
                'success' => true,
                'message' => 'Bank Berhasil Disimpan',
                'data' => $bank
            ]);
        } else {
            return response()->json(['message' => 'Bank Gagal Disimpan']);
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
