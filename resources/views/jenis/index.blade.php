@extends('layout.app')
  
@section('title')
  
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Jenis</h1>
        <br>

       
    </div>
    <br>
    
    <input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
    <br>
    


     
    <a href="{{ route('jenis.create') }}" class="btn btn-primary">Tambah Jenis</a>
    <!-- Tombol Export PDF -->
<a href="{{ route('jenis.exportPDF') }}" class="btn btn-success">Export PDF</a>
<!-- Tombol Import Excel -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Import Excel</button>

<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('jenis.importExcel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="file" class="form-label">Pilih file Excel</label>
                        <input class="form-control" type="file" name="file" id="file">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>

    </div>

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
        <tbody id="jenisTableBody">
            @if($jenis->count() > 0)
                @foreach($jenis as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->nama_jenis }}</td>

                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('jenis.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('jenis.destroy', $rs->id) }}" method="POST" class="delete-form" data-id="{{ $rs->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger m-0 delete-btn">Hapus</button>
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
@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
document.getElementById("searchInput").addEventListener("keyup", function() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("jenisTableBody");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Change index if the column where you want to search is different
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }   
        }
    }
});

  // Tambahkan event listener untuk setiap tombol "Hapus"
var deleteButtons = document.querySelectorAll('.delete-btn');
deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        var form = this.closest('.delete-form');
        var id = form.dataset.id;

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan dihapus secara permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            position: 'center' // Menempatkan SweetAlert2 di tengah layar
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit(); // Kirim permintaan penghapusan jika pengguna menekan "Yes"
            }
        });
    });
});


</script>
@endpush

