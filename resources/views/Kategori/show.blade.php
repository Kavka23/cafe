@extends('layout.app')
  
@section('title', 'Tampilan Product')
  
@section('contents')
    <h1 class="mb-0">Detail Kategori</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nama Kategori</label>
            <input type="text" name="nama" class="form-control" placeholder="nama" value="{{ $kategori->nama }}" readonly>
            <label class="form-label">Jenis</label>
            <input type="text" name="nama_jenis" class="form-control" placeholder="nama_jenis" value="{{ $kategori->jenis->nama_jenis }}" readonly>
    
        </div>  
    </div>
@endsection