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

    <div class="table-responsive col-lg-10">      
      <a href="/barang/create" class="btn btn-primary mb-2">Tambah Data Barang</a>      
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">{{ $title_kolom }}</th>
              <th scope="col">Jenis</th>
              <th scope="col">Stok</th>              
              <th scope="col">Action</th>              
            </tr>
          </thead>
          <tbody class="alldata"> 
            @foreach ($barang as $barang)
                <tr>                  
                    <td>{{ $barang->id }}</td>
                    <td>{{ $barang->nama_barang }}</td>
                    <td> {{ $barang->nama_tipe }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>
                        <a href="/barang/{{ $barang->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                        <form action="/barang/{{ $barang->id }}" method="post" class="d-inline"> 
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
      url : '{{URL::to('search')}}',
      data:{'search':$value},
    
      success:function(data){
        // console.log(data);
        $('#Content').html(data);
      }
    });
})
</script>
      
@endsection