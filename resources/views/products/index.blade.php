@extends('layout.app')

@section('contents')
<div class="container mt-5">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModalProduk">
        Tambah
    </button>
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

    document.querySelectorAll('.delete-product').forEach(item => {
        item.addEventListener('click', function() {
            let data = this.getAttribute('data-id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan bisa mengembalikan data yang sudah dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus saja!',
                cancelButtonText: 'Batalkan'
            }).then((result) => {
                if (result.isConfirmed) {
                    deleteProduct(data);
                }
            });
        });
    });

    function deleteProduct(data) {
        fetch(`/products/destroy/${data}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (response.ok) {
                location.reload();
            } else {
                throw new Error('Network response was not ok');
            }
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }
</script>
@endpush
