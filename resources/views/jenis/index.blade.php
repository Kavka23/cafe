@extends('layout.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Jenis</h1>
        <a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah Jenis</a>
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
                <th>Nama Jenis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($jenis->count() > 0)
                @foreach($jenis as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->nama_jenis }}</td>

                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('jenis.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('jenis.destroy', $rs->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Hapus?')">
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