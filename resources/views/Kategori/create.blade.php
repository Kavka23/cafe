@extends('layout.app')
  
@section('title', 'Tambah Kategori')
  
@section('contents')
    <h1 class="mb-0">Tambah</h1>
    <hr />
    
    <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group row">
                        <label for="jenis_id" class="col-sm-4 col-form-label">Jenis ID</label>
                        <div class="col-sm-8">
                            <select name="jenis_id" id="jenis_id">
                                <option value="">Pilih Jenis ID</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="nama" class="form-control" placeholder="nama">
            </div>
        </div>
       
 
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-info">Kirim</button>
            </div>
        </div>
    </form>
@endsection