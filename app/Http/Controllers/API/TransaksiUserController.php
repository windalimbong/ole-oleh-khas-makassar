<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use App\Models\TransaksiUser;
use Illuminate\Http\Request;

class TransaksiUserController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        return response()->json(['message' => 'success','transaksi' => $transaksi], 200);
    }

    public function store(Request $request)
    {
        $transaksi = Transaksi::find($request->transaksi);

        $transaksiuser = new TransaksiUser();
        $transaksiuser->id_transaksi = $request->transaksi;
        $transaksiuser->jumlah = $request->jumlah;
        $transaksiuser->total_harga = $transaksi->harga *= $request->jumlah;
        if($request->jumlah >= $transaksi->stock)
        {
            return response()->json(['message' => 'Stock Habis'], 200);
        }else{
            $transaksi->stock -= $request->jumlah;
        }
        $transaksi->save();
        $transaksiuser->save();
        return response()->json(['message' => 'Transaksi Berhasil'], 200);
    }
}
