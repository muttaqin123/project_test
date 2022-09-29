<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Detail;
use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
        ->join('barang', 'barang.id', '=', 'detail.id_barang')
        ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
        ->get();
        
        return view('dashboard.menu.transaksi', [
            'transaksi' => $detail,
            'title_table' => 'Menu Transaksi',
            'title_kolom' => 'Transaksi Barang'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $detail = Barang::join('detail', 'detail.id', '=', 'barang.id')->get();
        
        return view('dashboard.menu.create', [
            'title' => 'Transaksi Barang',
            'detail' => $detail
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jual = $request->terjual;
        $caribarang = $request->id_detail;
        $stokk = Barang::where('id', $caribarang)->first();
        $stokbaru = $stokk->stok - $jual;

        if($stokbaru>=0){
            $validatedData = $request->validate([            
                'terjual' => 'required',
                'tanggal_transaksi' => 'required',
                'id_detail' => 'required'
            ]);

            Barang::where('id', $stokk->id)->update([
                'stok' => $stokbaru
            ]);

            Transaksi::create($validatedData);

            return redirect('/transaksi')->with('success', 'Transaksi berhasil ditambah');
        }else{
            return redirect('/transaksi/create')->with('failedtransaksi', "Data habis, stok sisa " . $stokk->stok);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        // $barang = Barang::join('detail', 'detail.id', '=', 'barang.id')->get();    
        $detail1 = Detail::firstWhere('id', $transaksi->id_detail);
        $detail = Barang::join('detail', 'detail.id', '=', 'barang.id')->where('id_barang', $detail1->id_barang)->get();
        
        return view('dashboard.menu.edit', [
            'detail' => $detail,
            'transaksi' =>$transaksi,
            'title' => 'Transaksi Barang',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $rules = [
            'terjual' => 'required',
            'tanggal_transaksi' => 'required',
            'id_detail' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Transaksi::where('id', $transaksi->id)->update($validatedData);

        return redirect('/transaksi')->with('success', 'Transaksi barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        Transaksi::destroy($transaksi->id);
    
        return redirect('/transaksi')->with('success', 'Transaksi berhasil dihapus');
    }
}
