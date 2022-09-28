<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Detail;
use App\Models\Barang;
use Illuminate\Http\Request;

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

    public function urut(Request $request)
    {
        if($request->urutt == 'menaik'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
            ->orderBy('barang.nama_barang', 'asc')
            ->get();
        }elseif ($request->urutt == 'menurun'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
            ->orderBy('barang.nama_barang', 'desc')
            ->get();
        }elseif ($request->urutt == 'nonaktif'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')            
            ->get();
        }
        return view('dashboard.menu.transaksi', [
            'transaksi' => $detail,
            'title_table' => 'Menu Transaksi',
            'title_kolom' => 'Transaksi Barang'
        ]);
    }

    public function uruttanggal(Request $request)
    {
        if($request->uruttt == 'menaik'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
            ->orderBy('tanggal_transaksi', 'asc')
            ->get();
        }elseif ($request->uruttt == 'menurun'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
            ->orderBy('tanggal_transaksi', 'desc')
            ->get();
        }elseif ($request->uruttt == 'nonaktif'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')            
            ->get();
        }
        return view('dashboard.menu.transaksi', [
            'transaksi' => $detail,
            'title_table' => 'Menu Transaksi',
            'title_kolom' => 'Transaksi Barang'
        ]);
    }

    public function urutjual(Request $request)
    {
        if($request->urutjual == 'menaik'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
            ->orderBy('terjual', 'asc')
            ->get();
        }elseif ($request->urutjual == 'menurun'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
            ->orderBy('terjual', 'desc')
            ->get();
        }elseif ($request->urutjual == 'nonaktif'){
            $detail = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
            ->join('barang', 'barang.id', '=', 'detail.id_barang')
            ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')            
            ->get();
        }
        return view('dashboard.menu.transaksi', [
            'transaksi' => $detail,
            'title_table' => 'Menu Transaksi',
            'title_kolom' => 'Transaksi Barang'
        ]);
    }

    public function search(Request $request){
        $output = "";
        
        $transaksi = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
        ->join('barang', 'barang.id', '=', 'detail.id_barang')
        ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
        ->where('barang.nama_barang', 'Like', '%' . $request->search . '%' )        
        ->get();            

        foreach($transaksi as $transaksi){
            $output.=                         

            '<tr>
                <td>' .$transaksi->id . '</td>
                <td>' .$transaksi->nama_barang . '</td> 
                <td>' .$transaksi->terjual . '</td> 
                <td>' .$transaksi->tanggal_transaksi . '</td>                            
            <tr>';

        }
        
        return response($output);
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
        $validatedData = $request->validate([            
            'terjual' => 'required',
            'tanggal_transaksi' => 'required',
            'id_detail' => 'required'
        ]);

        Transaksi::create($validatedData);

        return redirect('/transaksi')->with('success', 'Transaksi berhasil ditambah');
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
        $barang = Barang::join('detail', 'detail.id', '=', 'barang.id')->get();        
        // $detail1 = Detail::firstWhere('id', $transaksi->id_detail);
        // $detail = Barang::join('detail', 'detail.id', '=', 'barang.id')->where('id_barang', $detail1->id_barang)->get();
        
        return view('dashboard.menu.edit', [
            'barang' => $barang,            
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
