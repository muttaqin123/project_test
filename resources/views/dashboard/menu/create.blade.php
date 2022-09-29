@extends('dashboard.layouts.main')

@section('container')

@if(session()->has('failedtransaksi'))
      <div class="alert alert-danger col-lg-12 mt-3" role="alert"> 
      {{ session('failedtransaksi') }}
      </div>
@endif

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    @if($title == 'Menu Barang')
        <h1 class="h2">Tambah Barang</h1>
    @elseif ($title == 'Tipe Barang')
        <h1 class="h2">Tambah Tipe Barang</h1>
    @elseif ($title == 'Transaksi Barang')
        <h1 class="h2">Transaksi Barang</h1>
    @endif
</div>

@if($title == 'Menu Barang')
<div class="col-lg-8">
    <form method="post" action="/barang" class="mb-5">
        @csrf
        <div class="mb-3">
          <label for="nama_barang" class="form-label">Nama Barang</label>
          <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}" required autofocus>
            @error('nama_barang')  
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror       
        </div>
        <div class="mb-3">
            <label for="id_tipe" class="form-label">Tipe Barang</label>
            <select class="form-select" name="id_tipe" required>
                <option value="" disabled selected hidden>Select your option</option>
                @foreach ($tipe as $tipe)              
                    <option value="{{ $tipe->id }}">{{ $tipe->nama_tipe }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok Barang</label>
            <input type="number" min="0" class="form-control" id="stok" name="stok"  value="{{ old('stok') }}" required>
            @error('stok')  
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror 
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@elseif ($title == 'Tipe Barang')
<div class="col-lg-8">
    <form method="post" action="/tipe" class="mb-5">
        @csrf
        <div class="mb-3">
          <label for="nama_tipe" class="form-label">Nama Tipe Barang</label>
          <input type="text" class="form-control @error('nama_tipe') is-invalid @enderror" id="nama_tipe" name="nama_tipe" value="{{ old('nama_tipe') }}" required autofocus>   
            @error('nama_tipe')  
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror       
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@elseif ($title == 'Transaksi Barang')
<div class="col-lg-8">
    <form method="post" action="/transaksi" class="mb-5">
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Nama Barang</label>
            <select class="form-select" name="id_detail" required>
                <option value="" disabled selected hidden>Select your option</option>
                @foreach ($detail as $detail)                    
                    <option value="{{ $detail->id }}">{{ $detail->nama_barang }}</option>                    
                @endforeach
              </select>
        </div> 
        <div class="mb-3">
            <label for="terjual" class="form-label">Jumlah Transaksi</label>
            <input type="number" min="1" class="form-control @error('terjual') is-invalid @enderror" id="terjual" name="terjual" value="{{ old('terjual') }}" required autofocus>   
              @error('terjual')  
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror       
          </div>
          <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ old('tanggal_transaksi') }}" required autofocus>   
              @error('tanggal_transaksi')  
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror       
          </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endif

@endsection