@extends('dashboard.layouts.main')

@section('container')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title_table }}</h1>        
    </div>

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-12" role="alert"> 
      {{ session('success') }}
      </div>
    @endif
    
    <div class="table-responsive col-lg-12 mb-3">      
      <a href="/transaksi/create" class="btn btn-primary">Tambah Transaksi</a>      
    </div>

    {{-- <form action="/uruttanggal" method="post"> --}}
      {{-- @csrf --}}
      <div class="mt-1">
        <p>Urut Jumlah Terjual Berdasarkan Tanggal =                      
          <input type="date" name="awal" id="awal" value="2000-01-01"> -
          <input type="date" name="akhir" id="akhir" value="2100-01-01">
          <button type="submit" style="border: 1px solid; color: black; padding: 1px 20px;
          text-align: center;text-decoration: none; display: inline-block;font-size: 16px;
          margin: 4px 10px;cursor: pointer; background-color:rgb(224, 215, 215);" id="buttonn">
          Terapkan</button>
        </p>
      </div>
    {{-- </form> --}}

    <div class="containerr">
      <table id ="myTable" class="table table-stripped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Terjual</th>
            <th scope="col">Transaksi</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody class="alldata">
          @foreach ($transaksi as $transaksii)
          <tr>          
            <td>{{ $transaksii->id }}</td>
            <td>{{ $transaksii->nama_barang }}</td>
            <td>{{ $transaksii->terjual }}</td>
            <td>{{ $transaksii->tanggal_transaksi }}</td>
            <td>              
              <form action="/transaksi/{{ $transaksii->id }}" method="post" class="d-inline"> 
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Anda yakin akan menghapus data ini?')">
                  <span data-feather="x-circle"></span>
                </button>
              </form>
            </td>
          </tr>
          @endforeach     
        </tbody>

        <tbody id="Content" class="searchdata"></tbody>
        
      </table>
    </div>

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
      
      <script>
        $(document).ready( function () {
          $('#myTable').DataTable();
        } );
      </script>

      <script type="text/javascript">
        $('#buttonn').on('click', function(){
          var awal = $("input[name='awal']").val();
          var akhir = $("input[name='akhir']").val();
              
          if(awal || akhir){
            $('.alldata').hide();
            $('.searchdata').show();
          }else{
            $('.alldata').show();
            $('.searchdata').hide();
          }
                
          $.ajax({
            type : 'get',
            url : '{{URL::to('uruttanggal')}}',
            data:{'awal':awal,'akhir':akhir},
          
            success:function(data){              
              $('#Content').html(data);
            }
          });
      })
      </script>


@endsection