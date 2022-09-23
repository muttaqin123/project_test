<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Detail;
use App\Models\Tipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $barang = Barang::max('id');
        // return $barang;
        $barang = Detail::join('barang', 'barang.id', '=', 'detail.id_barang')
        ->join('tipe', 'tipe.id', '=', 'detail.id_tipe')
        ->select('barang.id','barang.nama_barang', 'tipe.nama_tipe', 'stok')
        ->get();
        return view('dashboard.menu.barang', [
            'barang' => $barang,
            'title_table' => 'Menu Barang',
            'title_kolom' => 'Nama Barang'
        ]);
    }

    public function search(Request $request){
        $output = "";
        
        $barang = Detail::join('barang', 'barang.id', '=', 'detail.id_barang')
        ->join('tipe', 'tipe.id', '=', 'detail.id_tipe')
        ->where('barang.nama_barang', 'Like', '%' . $request->search . '%' )
        ->orWhere('tipe.nama_tipe', 'Like', '%' . $request->search . '%' )
        ->orWhere('barang.stok', 'Like', '%' . $request->search . '%' )
        ->select('barang.id','barang.nama_barang', 'tipe.nama_tipe', 'stok')
        ->get();
        
        // $posts = Post::join('categories', 'categories.id', '=', 'posts.category_id')
        // ->where('categories.name', 'Like', '%' . $request->search . '%' )
        // ->orWhere('posts.title', 'Like', '%' . $request->search . '%')->get();

        foreach($barang as $barang){
            $output.=                         

            '<tr>
                <td>' .$barang->id . '</td>
                <td>' .$barang->nama_barang . '</td>
                <td>' .$barang->nama_tipe . '</td>
                <td>' .$barang->stok . '</td>                    
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
        $tipe = Tipe::all();
        return view('dashboard.menu.create', [
            'title' => 'Menu Barang',
            'tipe' => $tipe
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
            'nama_barang' => 'required|max:50',
            'stok' => 'required'
        ]);

        Barang::create($validatedData);

        $barang = Barang::max('id');
        
        DB::table('detail')->insert([
            'id_barang' => $barang,
            'id_tipe' => $request->id_tipe
            ]);
        
        // Detail::create($barang,$validatedData2);

        return redirect('/barang')->with('success', 'Barang baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('dashboard.menu.edit', [
            'barang' => $barang,
            'title' => 'Menu Barang',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        $rules = [
            'nama_barang' => 'required|max:50',
            'stok' => 'required'
        ];

        $validatedData = $request->validate($rules);

        Barang::where('id', $barang->id)->update($validatedData);

        return redirect('/barang')->with('success', 'Barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
        Barang::destroy($barang->id);
    
        return redirect('/barang')->with('success', 'Barang berhasil dihapus');
    }

}
