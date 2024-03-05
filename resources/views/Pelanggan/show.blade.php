@extends('layout.app')
  
@section('title', 'Tampilan pelanggan')
  
@section('contents')
    <h1 class="mb-0">Detail Pelanggan</h1>
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan" value="{{ $pelanggan->nama_pelanggan }}" readonly>
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $pelanggan->email }}" readonly>
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="nomor_telepon" class="form-control" placeholder="Nomor Telepon" value="{{ $pelanggan->nomor_telepon }}" readonly>
            <label class="form-label">Alamat</label>
            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $pelanggan->alamat }}" readonly>
        </div>
    </div>
@endsection