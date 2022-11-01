<?php

namespace App\Http\Controllers;

use App\Models\TransaksiTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class TransaksiTransferController extends Controller
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
            'nilai_transfer' => 'required',
            'bank_tujuan' => 'required',
            'rekening_tujuan' => 'required',
            'atasnama_tujuan' => 'required',
            'bank_pengirim' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $kode_transaksi = "TF" . now()->format('ymd') . rand(10000, 99999);
        $kode_unix = rand(100, 999);
        $expired_at = now()->addDay();

        $transaksi = TransaksiTransfer::create([
            'nominal_transfer' => request('nilai_transfer'),
            'bank_to' => request('bank_tujuan'),
            'bank_rekening_to' => request('rekening_tujuan'),
            'name_rekening_to' => request('atasnama_tujuan'),
            'bank_from' => request('bank_pengirim'),
            'code_transaksi' => $kode_transaksi,
            'code_unix_payment' => $kode_unix,
            'expired_at' => $expired_at,
            'total_payment' => request('nilai_transfer') + $kode_unix,
            'biaya_admin' => 0
        ]);
        $rekening_tujuan = DB::table('banks')->where('banks.bank_account_rekening', request('rekening_tujuan'))->first();
        $rekening_perantara = DB::table('rekening_admins')->where('rekening_admins.name_bank_admin', request('bank_pengirim'))->first();
        if ($rekening_tujuan == "") {
            return response()->json([
                'message' => 'Nama Bank Tujuan belum terdaftar di database, Harap masukkan nama Bank Terlebih dahulu'
            ]);
        } else {
            if ($rekening_tujuan->bank_name == "" || $rekening_tujuan->bank_name != request('bank_tujuan')) {
                return response()->json([
                    'message' => 'Harap Periksa Nama Bank!, Nama Bank Tidak Terdaftar'
                ]);
            } else if ($rekening_tujuan->bank_account_rekening == "" || $rekening_tujuan->bank_account_rekening != request('rekening_tujuan')) {
                return response()->json([
                    'message' => 'Harap Periksa No Rekening!, No Rekening Tidak Terdaftar'
                ]);
            }
            if ($rekening_perantara == "") {
                return response()->json([
                    'message' => 'Nama Bank Pengirim Yang Dimasukkan Belum Terdaftar di database'
                ]);
            } else {
                if ($transaksi) {
                    return response()->json([
                        'id_transaksi' => $transaksi->code_transaksi,
                        'nilai_transfer' => $transaksi->nominal_transfer,
                        'kode_unik' => $transaksi->code_unix_payment,
                        'biaya_admin' => $transaksi->biaya_admin,
                        'total_transfer' => $transaksi->total_payment,
                        'bank_perantara' => $rekening_perantara->name_bank_admin,
                        'rekening_perantara' => $rekening_perantara->rekening_admin,
                        'berlaku_hingga' => $transaksi->expired_at,
                        'nama_rekening_tujuan' => $rekening_tujuan->bank_account_rekening,
                        'success' => true,
                        'message' => 'Transaksi Berhasil Disimpan',
                    ]);
                } else {
                    return response()->json([
                        'message' => 'Transaksi Gagal Disimpan'
                    ]);
                }
            }
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
