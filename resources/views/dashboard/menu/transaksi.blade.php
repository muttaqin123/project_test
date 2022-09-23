@extends('dashboard.layouts.main')

@section('container')

  <div class="container">
    <div class="search">
        <input type="search" name="search" id="search" placeholder="search" class="form-control mt-3">
    </div>
  </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title_table }}</h1>        
    </div>

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-10" role="alert"> 
      {{ session('success') }}
      </div>
    @endif
    
    <div class="table-responsive col-lg-12">      
      <a href="/transaksi/create" class="btn btn-primary">Tambah Transaksi</a>      
      <p>
        <form action="/urut" method="post">
          @csrf
          <div class="mt-3">
            Urut Berdasarkan Nama =  
              <select name="urutt">        
                <option value="nonaktif" selected>Nonaktif</option>        
                <option value="menaik">Menaik</option>
                <option value="menurun">Menurun</option>
              </select>
              <button type="submit" style="border: 1px solid; color: black; padding: 1px 20px;
              text-align: center;text-decoration: none; display: inline-block;font-size: 16px;
              margin: 4px 10px;cursor: pointer; background-color:rgb(224, 215, 215);">
              Terapkan</button>
          </div>
        </form>
      </p>

      <form action="/uruttanggal" method="post">
        @csrf
        <div class="mt-1">
          <p>Urut Berdasarkan Tanggal =  
            <select name="uruttt">  
              <option value="nonaktif" selected>Nonaktif</option>        
              <option value="menaik">Menaik</option>
              <option value="menurun">Menurun</option>
            </select>
            <button type="submit" style="border: 1px solid; color: black; padding: 1px 20px;
            text-align: center;text-decoration: none; display: inline-block;font-size: 16px;
            margin: 4px 10px;cursor: pointer; background-color:rgb(224, 215, 215);">
            Terapkan</button>
          </p>
        </div>
      </form>

      <form action="/urutjual" method="post">
        @csrf
        <div class="mt-1">
          <p>Urut Berdasarkan Jumlah Terjual =  
            <select name="urutjual">  
              <option value="nonaktif" selected>Nonaktif</option>        
              <option value="menaik">Menaik</option>
              <option value="menurun">Menurun</option>
            </select>
            {{-- Pilih Rentang Waktu
            <input type="date" name="awal" id="awal"> -
            <input type="date" name="akhir" id="akhir"> --}}
            <button type="submit" style="border: 1px solid; color: black; padding: 1px 20px;
            text-align: center;text-decoration: none; display: inline-block;font-size: 16px;
            margin: 4px 10px;cursor: pointer; background-color:rgb(224, 215, 215);">
            Terapkan</button>
          </p>
        </div>
      </form>

        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nama Barang</th>              
              <th scope="col">Terjual</th>
              <th scope="col">Tanggal Transaksi</th>
              <th scope="col">Action</th>              
            </tr>
          </thead>
          <tbody class="alldata">
            @foreach ($transaksi as $transaksi)
                <tr>                  
                    <td>{{ $transaksi->id }}</td>
                    <td>{{ $transaksi->nama_barang }}</td>
                    <td>{{ $transaksi->terjual }}</td>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>
                        <a href="/transaksi/{{ $transaksi->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/transaksi/{{ $transaksi->id }}" method="post" class="d-inline"> 
                          @method('delete')
                          @csrf
                          <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin akan menghapus data ini?')">
                            <span data-feather="x-circle"></span>
                          </button>
                        </form>
                    </td>
                <tr>                  
            @endforeach 
            
          </tbody>

          <tbody id="Content" class="searchdata"></tbody>

        </table>
      </div>
    
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript">
        $('#search').on('keyup', function(){
          // alert('hello');
          $value=$(this).val();
          // console.log('tolo');
          if($value){
            $('.alldata').hide();
            $('.searchdata').show();
          }else{
            $('.alldata').show();
            $('.searchdata').hide();
          }
          
          $.ajax({          
            type : 'get',
            url : '{{URL::to('searchhh')}}',
            data:{'search':$value},
          
            success:function(data){
              // console.log(data);
              $('#Content').html(data);
            }
          });
      })
      </script>

@endsection