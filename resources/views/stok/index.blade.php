@extends('layout.app')

@section('contents')

<div class="container mt-5">
    <h1>Stok</h1>
    
<input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">

 <br>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#FormModalStok">
    Tambah
</button>
 <!-- Tombol Export PDF -->
 <a href="{{ route('stok.exportPDF') }}" class="btn btn-success">Export PDF</a>
    <hr>
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif
    @include('stok.data')
    @include('stok.form')
</div>
@endsection


@push('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> <!-- Include Sweet Alert library -->


<script>

   

    $('.alert-success').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-success').slideUp(500)
    })
    $('.alert-danger').fadeTo(2000, 500).slideUp(500, function() {
        $('.alert-danger').slideUp(500)
    })

    console.log($('.delete-data'))

    document.querySelectorAll('.btn-delete').forEach(item => {
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
                    // Jika dikonfirmasi, lanjutkan dengan penghapusan
                    Swal.fire(
                        'Terhapus!',
                        'Data telah berhasil dihapus.',
                        'success'
                    );
                    // Send DELETE request
                    deleteProduct(data);
                    location.reload();

                }
            });
        });
    });

    function deleteProduct(data) {
        fetch(`/stok/destroy/${data}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            // Redirect to another page or refresh the current page
            location.reload(); // For example, reload the current page
        })
        .catch(error => {
            console.error('There has been a problem with your fetch operation:', error);
        });
    }

    $('#FormModalStok').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const products_id = btn.data('products_id')
        const stok = btn.data('stok')
        const id = btn.data('id')
        const modal = $(this)
        if (mode === 'edit') {
            modal.find('#method').html('@method('PATCH')');
            modal.find('.modal-title').text('Edit Data Stok')
            modal.find('#products_id').val(products_id)
            modal.find('#stok').val(stok)
            modal.find('.modal-body form').attr('action', '{{ url("stok")}}/' + id)
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data Stok')
            modal.find('#products_id').val('')
            modal.find('#stok').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("stok") }}')
        }
    })
    
    document.getElementById("searchInput").addEventListener("keyup", function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("stokTableBody");
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
</script>
@endpush
