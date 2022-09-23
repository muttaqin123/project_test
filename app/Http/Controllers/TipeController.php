<?php

namespace App\Http\Controllers;

use App\Models\Tipe;
use Illuminate\Http\Request;

class TipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipe = Tipe::all();        

        return view('dashboard.menu.tipe', [
            'tipe' => $tipe,
            'title_table' => 'Menu Tipe Barang',
            'title_kolom' => 'Tipe Barang'
        ]);
    }

    public function search(Request $request){
        $output = "";
        
        $tipe = Tipe::where('nama_tipe', 'Like', '%' . $request->search . '%' )->get();      

        foreach($tipe as $tipe){
            $output.=                         

            '<tr>
                <td>' .$tipe->id . '</td>
                <td>' .$tipe->nama_tipe . '</td>                            
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
        return view('dashboard.menu.create', [
            'title' => 'Tipe Barang',
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
            'nama_tipe' => 'required|max:50',            
        ]);

        Tipe::create($validatedData);

        return redirect('/tipe')->with('success', 'Tipe barang baru berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tipe  $tipe
     * @return \Illuminate\Http\Response
     */
    public function show(Tipe $tipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tipe  $tipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Tipe $tipe)
    {
        return view('dashboard.menu.edit', [
            'tipe' => $tipe,
            'title' => 'Tipe Barang',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tipe  $tipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tipe $tipe)
    {
        $rules = [
            'nama_tipe' => 'required|max:50',            
        ];

        $validatedData = $request->validate($rules);

        Tipe::where('id', $tipe->id)->update($validatedData);

        return redirect('/tipe')->with('success', 'Tipe barang berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tipe  $tipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tipe $tipe)
    {
        Tipe::destroy($tipe->id);
    
        return redirect('/tipe')->with('success', 'Tipe barang berhasil dihapus');
    }
}
