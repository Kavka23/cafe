@extends('layout.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Kategori</h1>
        <a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah Kategori</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($kategori->count() > 0)
                @foreach($kategori as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->nama }}</td>

                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('kategori.show', $rs->id)}}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('kategori.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('kategori.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">NONE</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection