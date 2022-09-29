@extends('dashboard.layouts.main')

@section('container')    

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title_table }}</h1>        
    </div>

    @if(session()->has('success'))
      <div class="alert alert-success col-lg-10" role="alert"> 
      {{ session('success') }}
      </div>
    @endif

    @if(session()->has('failed'))
      <div class="alert alert-danger col-lg-12" role="alert"> 
      {{ session('failed') }}
      </div>
    @endif

    <div class="table-responsive col-lg-10 mb-3">
      <a href="/tipe/create" class="btn btn-primary mb-2">Tambah Daftar Tipe Barang</a>
    </div>  

    <div class="containerr">
      <table id ="myTable" class="table table-stripped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{ $title_kolom }}</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tipe as $tipe)
          <tr>          
            <td>{{ $tipe->id }}</td>     
            <td>{{ $tipe->nama_tipe }}</td>
            <td>
              <a href="/tipe/{{ $tipe->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
              <form action="/tipe/{{ $tipe->id }}" method="post" class="d-inline"> 
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