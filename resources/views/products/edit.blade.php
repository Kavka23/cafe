@extends('layout.app')
  
@section('title', 'Edit Produk')
  
@section('contents')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Produk') }}</div>
  
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
  
                   
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Nama Produk" value="{{ $product->nama_produk }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="jenis_id" class="form-label">Jenis</label>
                            <select name="jenis_id" id="jenis_id" class="form-select">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}" {{ $product->jenis_id == $j->id ? 'selected' : '' }}>{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
  
                        <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Deskripsi">{{ $product->deskripsi }}</textarea>
        </div>

  
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Harga" value="{{ $product->harga }}">
                        </div>
  
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="img" id="img" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                            <img id="imgPreview" src="{{ asset('img/'.$product->img) }}" alt="Preview" style="max-width: 300px; max-height: 300px; margin-top: 10px;">
                        </div>
  
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Perbarui Produk</button>
                        </div>
                    </form>
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
        background-color: #007bff;
        color: white;
        font-weight: bold;
        text-align: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .form-label {
        font-weight: bold;
    }
</style>
@endpush

@push('script')
<script>
    function previewImage(event) {
        const imgPreview = document.getElementById('imgPreview');
        imgPreview.style.display = 'block';

        const reader = new FileReader();
        reader.onload = function() {
            imgPreview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
