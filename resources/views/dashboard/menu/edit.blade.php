@extends('dashboard.layouts.main')

@section('container')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ubah Data</h1>        
</div>

@if($title == 'Menu Barang')
<div class="col-lg-8">
    <form method="post" action="/barang/{{ $barang->id }}" class="mb-5" >
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" id="nama_barang" name="nama_barang" value="{{ old('nama_barang' , $barang->nama_barang) }}" required autofocus>   
              @error('nama_barang')  
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror       
          </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok Barang</label>
            <input type="number" class="form-control" id="stok" name="stok"  value="{{ old('stok', $barang->stok) }}" required>
            @error('stok')  
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror 
        </div>
        {{-- <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category_id">
                @foreach ($categories as $category)
                    @if(old('category_id', $post->category->id) == $category->id)
                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                @endforeach
              </select>
        </div> --}}

        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
</div>
@elseif ($title == 'Tipe Barang')
<div class="col-lg-8">
    <form method="post" action="/tipe/{{ $tipe->id }}" class="mb-5" >
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="nama_tipe" class="form-label">Nama Tipe Barang</label>
            <input type="text" class="form-control @error('nama_tipe') is-invalid @enderror" id="nama_tipe" name="nama_tipe" value="{{ old('nama_tipe' , $tipe->nama_tipe) }}" required autofocus>   
              @error('nama_tipe')  
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror       
          </div>        
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
</div>
@elseif ($title == 'Transaksi Barang')
<div class="col-lg-8">
    <form method="post" action="/transaksi/{{ $transaksi->id }}" class="mb-5">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="category" class="form-label">Nama Barang</label>
            <select class="form-select" name="id_detail">
                @foreach ($barang as $barang)
                    @if(old('id_detail') == $barang->nama_barang)
                        <option value="{{ $barang->id }}" selected>{{ $barang->nama_barang }}</option>
                    @else
                        <option value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                    @endif
                @endforeach
              </select>
        </div> 
        <div class="mb-3">
            <label for="terjual" class="form-label">Jumlah Transaksi</label>
            <input type="number" class="form-control @error('terjual') is-invalid @enderror" id="terjual" name="terjual" value="{{ old('terjual', $transaksi->terjual) }}" required autofocus>   
              @error('terjual')  
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror       
          </div>
          <div class="mb-3">
            <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control @error('tanggal_transaksi') is-invalid @enderror" id="tanggal_transaksi" name="tanggal_transaksi" value="{{ old('tanggal_transaksi', $transaksi->tanggal_transaksi) }}" required autofocus>   
              @error('tanggal_transaksi')  
                  <div class="invalid-feedback">
                      {{ $message }}
                  </div>
              @enderror       
          </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
</div>
@endif

@endsection