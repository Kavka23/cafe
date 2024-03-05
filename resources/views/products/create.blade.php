@extends('layout.app')
  
@section('title', 'Tambah Produk')
  
@section('contents')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tambah Produk') }}</div>
  
                <div class="card-body">
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf
  
                      
  
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukkan Nama Produk">
                        </div>

                        <div class="mb-3">
                            <label for="jenis_id" class="form-label">Jenis</label>
                            <select name="jenis_id" id="jenis_id" class="form-select">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
  
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="text" name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Produk">
                        </div>
  
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga Produk" min="0">
                        </div>

  
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="img" id="img" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                            <img id="imgPreview" src="#" alt="Preview" style="display: none; max-width: 300px; max-height: 300px; margin-top: 10px;">
                        </div>
  
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Tambah Produk</button>
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

    function validateForm() {
        const nama_produk = document.getElementById('nama_produk').value;
        const jenis_id = document.getElementById('jenis_id').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const harga = document.getElementById('harga').value;

        if (nama_produk.trim() === '' || jenis_id === '' || deskripsi.trim() === '' || harga.trim() === '') {
            alert('Harap isi semua field sebelum mengirimkan form.');
            return false;
        }

        return true;
    }
</script>
@endpush
