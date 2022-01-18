<?php

namespace App\Http\Controllers;

use App\DataTables\TransaksiDataTable;
use App\Models\Transaksi;
use Exception;
use Illuminate\Http\Request;
// use RealRashid\SweetAlert\Facades\Alert;

class TransaksiAdminController extends Controller
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
    public function index(TransaksiDataTable $dataTable)
    {
        return $dataTable->render('layouts.admin.transaksi.index');
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
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|mimes:png,jpg,jpeg',
            'harga' => 'required',
            'stock' => 'required'
        ]);

        try{
        $transaksi = new Transaksi();
        $transaksi->nama = $request->nama;
        $transaksi->deskripsi = $request->deskripsi;
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path(). '/assets/image', $filename);
            $transaksi->gambar = $filename;
        }
        $transaksi->harga = $request->harga;
        $transaksi->stock = $request->stock;
        $transaksi->save();
        return redirect()->back()->with('success',' Tambah data transaksi berhasil.');
    } catch(Exception $e){
        return redirect()->back()->with('failed',' Tambah data transaksi gagal.');
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
        try{
            $transaksi = Transaksi::find($id);
            $transaksi->nama = $request->nama;
            $transaksi->deskripsi = $request->deskripsi;
            if($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path(). '/assets/image', $filename);
                $filehapus = public_path('/assets/image/').$transaksi->gambar;
                if(file_exists($filehapus)){
                    @unlink($filehapus);
                }
                $transaksi->gambar = $filename;
            }
            $transaksi->harga = $request->harga;
            $transaksi->stock = $request->stock;
            $transaksi->save();
            return redirect()->back()->with('success',' Update data transaksi berhasil.');
    } catch(Exception $e){
        return redirect()->back()->with('failed',' Update data transaksi gagal.');
    }
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
            Transaksi::where('id', $id)->delete();
            return redirect()->back()->with('success',' Hapus data transaksi berhasil.');
        } catch (Exception $e) {
            return redirect()->back()->with('failed',' Hapus data transaksi gagal.');
        }
    }

    public function actiontransaksi($action, $id)
    {
        $transaksi =  Transaksi::where('id', $id)->first();
        if (count($transaksi->get()) > 0) {
            if ($action == "hapus") {
                $returnHTML = view('layouts.admin.transaksi.hapus', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            } elseif ($action == "edit") {
                $returnHTML = view('layouts.admin.transaksi.edit', ['data' => $transaksi])->render();
                return response()->json(['html' => $returnHTML]);
            }
        } else {
            return redirect()->back()->with('failed',' Tampilkan data transaksi gagal.');
        }
    }
}
