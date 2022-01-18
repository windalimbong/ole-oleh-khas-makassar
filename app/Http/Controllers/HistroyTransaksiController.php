<?php

namespace App\Http\Controllers;

use App\DataTables\HistoryTransaksiDataTable;
use App\Models\TransaksiUser;
use Exception;
use Illuminate\Http\Request;

class HistroyTransaksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HistoryTransaksiDataTable $dataTable)
    {
        return $dataTable->render('layouts.admin.history.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        try {
            TransaksiUser::where('id', $id)->delete();
            return redirect()->back()->with('success',' Hapus data transaksi berhasil.');
        } catch (Exception $e) {
            return redirect()->back()->with('failed',' Hapus data transaksi gagal.');
        }
    }

    public function actionhistory($action, $id)
    {
        $transaksi =  TransaksiUser::where('id', $id)->first();
        if (count($transaksi->get()) > 0) {
            if ($action == "hapus") {
                $returnHTML = view('layouts.admin.history.hapus', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            }
        } else {
            return redirect()->back()->with('failed',' Tampilkan data transaksi gagal.');
        }
    }
}
