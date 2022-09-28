@extends('dashboard.layouts.main')

@section('container')

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title_table }}</h1>        
    </div>

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-10" role="alert"> 
      {{ session('success') }}
      </div>
    @endif
    
    <div class="table-responsive col-lg-12 mb-3">      
      <a href="/transaksi/create" class="btn btn-primary">Tambah Transaksi</a>      
    </div>
    
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
        <tbody>
          @foreach ($transaksi as $transaksii)
          <tr>          
            <td>{{ $transaksii->id }}</td>
            <td>{{ $transaksii->nama_barang }}</td>
            <td>{{ $transaksii->terjual }}</td>
            <td>{{ $transaksii->tanggal_transaksi }}</td>
            <td>
              <a href="/transaksi/{{ $transaksii->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
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