@extends('layout.app')

@section('contents')
<h1>Produk Makanan & Minuman</h1>
<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModalProduk">
        Tambah
    </button>
     <!-- Tombol Export PDF -->
     <a href="{{ route('products.exportPDF') }}" class="btn btn-success">Export PDF</a>

<!-- Tombol Import Excel -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Import Excel</button>

<!-- Modal Import Excel -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('products.importExcel') }}" method="POST" enctype="multipart/form-data">
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

    <div class="container mt-5">
    <!-- Tambahkan tombol lainnya sesuai kebutuhan -->
    <hr>
    <!-- Sisanya dari tampilan Anda -->
</div>

    <hr>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    @include('products.data')
    @include('products.form')
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $('#formModalProduk').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget);
        const mode = btn.data('mode');
        const nama_produk = btn.data('nama_produk');
        const jenis_id = btn.data('jenis_id');
        const harga = btn.data('harga');
        const deskripsi = btn.data('deskripsi');
        const id = btn.data('id');
        const modal = $(this);
        if (mode === 'edit') {
            modal.find('#method').html('@method('PATCH')');
            modal.find('.modal-title').text('Edit Data Menu');
            modal.find('#nama_produk').val(nama_produk);
            modal.find('#harga').val(harga);
            modal.find('#jenis_id').val(jenis_id);
            modal.find('#deskripsi').val(deskripsi);
            modal.find('#foto_sebelumnya').attr('src', btn.data('foto_sebelumnya'));
            modal.find('.modal-body form').attr('action', '{{ url('products') }}/' + id);
        } else {
            modal.find('#nama_produk').val('');
            modal.find('#harga').val('');
            modal.find('#jenis_id').val('');
            modal.find('#deskripsi').val('');
            modal.find('#method').html('');
            modal.find('.modal-body form').attr('action', '{{ url('products') }}');
            modal.find('.modal-title').text('Input Data Menu');
        }
    });

    document.getElementById("searchInput").addEventListener("keyup", function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("productTableBody");
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

    $('.delete-data').on('click', function(e) {
        console.log('deleteeee')
        e.preventDefault()
        const data = $(this).closest('tr').find('td:eq(1)').text()
        Swal.fire({
            title: `Apakah data <span style ="color:red">${data}</span> akan dihapus?`,
            text: "data tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus data ini!'
        }).then((result) => {
            if (result.isConfirmed)
                $(e.target).closest('form').submit()
            else swal.close()
        })
    })
    
</script>
@endpush
