<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Detail;
use App\Models\Barang;
use Exception;

use function PHPUnit\Framework\isNull;

class ApiTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Detail::join('transaksi', 'transaksi.id_detail', '=', 'detail.id')
        ->join('barang', 'barang.id', '=', 'detail.id_barang')
        ->select('transaksi.id','transaksi.id_detail','barang.nama_barang', 'terjual', 'tanggal_transaksi')
        ->get();

        if($data){
            return ApiFormatter::createApi(200, 'Success', $data);
        }else{
            return ApiFormatter::createApi(400, 'Failed');
        }
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
        try{
            $request->validate([
                'terjual' => 'required',
                'tanggal_transaksi' => 'required',
                'id_detail' => 'required'
            ]);

            $transaksi = Transaksi::create([
                'terjual' => $request->terjual,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'id_detail' => $request->id_detail
            ]);

            $data = Transaksi::where('id', '=', $transaksi->id)->get();

            if($data){
                return ApiFormatter::createApi(200, 'Success', $data);
            }else{
                return ApiFormatter::createApi(400, 'Semua Data Wajib Diisi');
            }
        }catch(Exception $error){
            return ApiFormatter::createApi(400, 'Semua Data Wajib Diisi');
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
        try{
            $data2 = Transaksi::findOrFail($id);
            $data = Transaksi::where('id', '=', $id)->get();
            
            if($data){
                return ApiFormatter::createApi(200, 'Success', $data);
            }else{
                return ApiFormatter::createApi(400, 'Failed');
            }
        }catch(Exception $error){
            return ApiFormatter::createApi(400, 'Data tidak ditemukan');
        }
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
            $request->validate([
                'terjual' => 'required',
                'tanggal_transaksi' => 'required',
                'id_detail' => 'required'
            ]);
            
            $transaksi = Transaksi::findOrFail($id);

            $transaksi->update([
                'terjual' => $request->terjual,
                'tanggal_transaksi' => $request->tanggal_transaksi,
                'id_detail' => $request->id_detail
            ]);

            $data = Transaksi::where('id', '=', $transaksi->id)->get();

            if($data){
                return ApiFormatter::createApi(200, 'Success', $data);
            }else{
                return ApiFormatter::createApi(400, 'Semua inputan wajib diisi');
            }
        }catch(Exception $error){
            return ApiFormatter::createApi(400, 'ID data tidak ditemukan');
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
        try{
            $transaksi = Transaksi::findOrFail($id);

            $data = $transaksi->delete();

            if($data){
                return ApiFormatter::createApi(200, 'Success');
            }else{
                return ApiFormatter::createApi(400, 'Failed');
            }
        }catch(Exception $error){
            return ApiFormatter::createApi(400, 'Data Tidak Ditemukan');
        }
    }
}
