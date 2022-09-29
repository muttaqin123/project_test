@extends('dashboard.layouts.main')

@section('container')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title_table }}</h1>        
    </div>

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-12" role="alert"> 
      {{ session('success') }}
      </div>
    @endif

    @if(session()->has('failed'))
      <div class="alert alert-danger col-lg-12" role="alert"> 
      {{ session('failed') }}
      </div>
    @endif

    <div class="table-responsive col-lg-10 mb-3">
      <a href="/barang/create" class="btn btn-primary mb-2">Tambah Data Barang</a>      
    </div>
      
    <div class="containerr">
      <table id ="myTable" class="table table-stripped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ $title_kolom }}</th>
            <th scope="col">Jenis</th>
            <th scope="col">Stok</th>              
            <th scope="col">Action</th>              
          </tr>
        </thead>
        <tbody>
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
          </tr>
          @endforeach     
        </tbody>
      </table>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
      
<script>
  $(document).ready( function () {
    $('#myTable').DataTable();
  } );
</script>

@endsection