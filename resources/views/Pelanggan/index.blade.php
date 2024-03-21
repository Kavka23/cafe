@extends('layout.app')
  
@section('title')
  
@section('contents')
    
        <h1 class="mb-0">List Pelanggan</h1>
        <br>
        <input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
        <br>
        <a href="{{ route('pelanggan.create') }}" class="btn btn-primary">Tambah Pelanggan</a>
          <!-- Tombol Export PDF -->
     <a href="{{ route('pelanggan.exportPDF') }}" class="btn btn-success">Export PDF</a>

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
                <th>Nama Pelanggan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="pelangganTableBody">
            @if($pelanggan->count() > 0)
                @foreach($pelanggan as $rs)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $rs->nama_pelanggan }}</td>

                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('pelanggan.show', $rs->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                <a href="{{ route('pelanggan.edit', $rs->id)}}" type="button" class="btn btn-warning">Edit</a>
                                <form action="{{ route('pelanggan.destroy', $rs->id) }}" method="POST" class="delete-form" data-id="{{ $rs->id }}">
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
    table = document.getElementById("pelangganTableBody");
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
