@extends('layout.app')
  
@section('title', 'Tambah pelanggan')
  
@section('contents')
    <h1 class="mb-0">Tambah</h1>
    <hr />
    <form action="{{ route('pelanggan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
    <div class="col">
        <label class="form-label">Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" id="nama_pelanggan" class="form-control" placeholder="Nama Pelanggan (Tanpa Angka)">
    </div>
</div>

<script>
    // Memastikan hanya huruf yang diizinkan di input nama_pelanggan
    document.getElementById('nama_pelanggan').addEventListener('input', function(event) {
        let value = event.target.value;
        // Menghapus semua karakter angka dari input
        event.target.value = value.replace(/\d/g, '');
    });
</script>
           
        
        <div class="row mb-3">
            <div class="col">
            <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email">
            </div>
            </div>

            
            <div class="row mb-3">
    <div class="col">
        <label class="form-label">Nomor Telepon</label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" placeholder="Nomor Telepon">
    </div>
</div>

<script>
    // Memastikan hanya angka yang diizinkan di input nomor_telepon
    document.getElementById('nomor_telepon').addEventListener('input', function(event) {
        let value = event.target.value;
        // Menghapus semua karakter non-angka dari input
        event.target.value = value.replace(/\D/g, '');
    });
</script>


<div class="row mb-3">
    <div class="col">
        <label class="form-label">Alamat</label>
        <input type="text" name="alamat" id="alamat" class="form-control" placeholder="Alamat">
    </div>
</div>

<script>
    // Memastikan hanya huruf dan simbol yang diizinkan di input alamat
    document.getElementById('alamat').addEventListener('input', function(event) {
        let value = event.target.value;
        // Menghapus semua karakter angka dari input
        event.target.value = value.replace(/\d/g, '');
    });
</script>

            

 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-info">Kirim</button>
            </div>
        </div>
    </form>
@endsection