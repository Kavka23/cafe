@extends('layout.app')
  
@section('title', 'Edit Kategori')
  
@section('contents')
    <h1 class="mb-0">Edit Kategori</h1>
    <hr />
    <form action="{{ route('Kategori.update', $kategori->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" placeholder="nama" value="{{ $kategori->nama}}">
            </div>
        </div>
        <div class="form-group row">
            <label for="jenis_id" class="col-sm-4 col-form-label">Jenis ID</label>
            <div class="col-sm-8">
                <select name="jenis_id" id="jenis_id">
                    <option value="">Pilih Jenis ID</option>
                        @foreach ($jenis as $j)
                        @if($kategori->jenis_id == $j->id)
                            <option selected value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                        @else
                            <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
        
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Perbarui</button>
            </div>
        </div>
    </form>
@endsection