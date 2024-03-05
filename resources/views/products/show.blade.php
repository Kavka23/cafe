@extends('layout.app')
  
@section('title', 'Detail Produk')
  
@section('contents')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            Detail Produk
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <label class="form-label">Nama Jenis:</label>
                    <input type="text" name="nama_jenis" class="form-control" value="{{ $product->jenis->nama_jenis }}" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label">Nama Produk:</label>
                    <input type="text" name="nama_produk" class="form-control" value="{{ $product->nama_produk }}" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label">Deskripsi:</label>
                    <input type="text" name="deskripsi" class="form-control" value="{{ $product->deskripsi }}" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label">Harga:</label>
                    <input type="text" name="harga" class="form-control" value="{{ $product->harga }}" readonly>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <label class="form-label">Gambar:</label>
                    <br>
                    @if($product->img)
                        <img src="{{ asset('img/'.$product->img) }}" class="img-fluid" alt="Product Image">
                    @else
                        <span class="text-muted">Tidak ada gambar yang diunggah</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
    .card {
        border-radius: 15px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 15px 15px 0 0;
    }

    .form-label {
        font-weight: bold;
    }
</style>
@endpush
