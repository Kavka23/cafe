@extends('layout.app')
  
@section('title', 'Tampilan Jenis')
  
@section('contents')
    <h1 class="mb-0">Detail Jenis</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nama Jenis</label>
            <input type="text" name="nama_jenis" class="form-control" placeholder="nama_jenis" value="{{ $jenis->nama_jenis }}" readonly>
        </div>

    </div>
@endsection