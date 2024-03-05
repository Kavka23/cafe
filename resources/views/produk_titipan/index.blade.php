@extends('layout.app')

@section('contents')

<div class="container mt-5">
   
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#FormModalProdukTitipan">
        Tambah
    </button>
    <div class="container mt-5">
    <!-- Tombol Export PDF -->
    <a href="{{ route('produk_titipan.exportPDF') }}" class="btn btn-success">Export PDF</a>

    <!-- Tombol Import Excel -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importModal">Import Excel</button>

    <!-- Modal Import Excel -->
    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('produk_titipan.importExcel') }}" method="POST" enctype="multipart/form-data">
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

    <!-- Tampilkan pesan sukses jika ada -->
    @if(Session::has('success'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
    </div>
    @endif

    <!-- Tampilkan data produk titipan -->
    @include('produk_titipan.data')
    @include('produk_titipan.form')
</div>

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
                    deleteProduk(data);
                    location.reload();

                }
            });
        });
    });

    function deleteProduk(data) {
        fetch(`/produk_titipan/destroy/${data}`, {
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

    $('#FormModalProdukTitipan').on('show.bs.modal', function(e) {
        const btn = $(e.relatedTarget)
        const mode = btn.data('mode')
        const nama_produk = btn.data('nama_produk')
        const nama_supplier = btn.data('nama_supplier')
        const harga_beli = btn.data('harga_beli')
        const harga_jual = btn.data('harga_jual')
        const stok = btn.data('stok')
        const keterangan = btn.data('keterangan')
        const id = btn.data('id')
        const modal = $(this)
        if (mode === 'edit') {
            modal.find('#method').html('@method('PATCH')');
            modal.find('.modal-title').text('Edit Data Stok')
            modal.find('#nama_produk').val(nama_produk)
            modal.find('#nama_supplier').val(nama_supplier)
            modal.find('#harga_beli').val(harga_beli)
            modal.find('#harga-jual').val(harga_jual)
            modal.find('#stok').val(stok)
            modal.find('#keterangan').val(keterangan)
            modal.find('.modal-body form').attr('action', '{{ url("produk_titipan")}}')
            modal.find('#method').html('@method("PATCH")')
        } else {
            modal.find('.modal-title').text('Input Data ')
            modal.find('#nama_produk').val('')
            modal.find('#nama_supplier').val('')
            modal.find('#harga_beli').val('')
            modal.find('#harga-jual').val('')
            modal.find('#stok').val('')
            modal.find('#keterangan').val('')
            modal.find('#method').html('')
            modal.find('.modal-body form').attr('action', '{{ url("produk_titipan")}}')
        }
    })
</script>
@endpush
