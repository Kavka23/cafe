
<div class="modal fade" id="formModalProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card-body">
                    <form action="products" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        @csrf
                        <div id="method"></div>
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" placeholder="Masukkan Nama Produk">
                        </div>

                        <div class="mb-3">
                            <label for="jenis_id" class="form-label">Jenis</label>
                            <select name="jenis_id" id="jenis_id" class="form-select">
                                <option value="">Pilih Jenis</option>
                                @foreach ($jenis as $j)
                                    <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                                @endforeach
                            </select>
                        </div>
  
                        <div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" id="deskripsi" class="form-control" placeholder="Masukkan Deskripsi Produk"></textarea>
</div>

  
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukkan Harga Produk" min="0">
                        </div>

  
                        <div class="mb-3">
                            <label class="form-label">Foto</label>
                            <input type="file" name="img" id="img" class="form-control-file" accept="image/*" onchange="previewImage(event)">
                            <img id="imgPreview" src="#" alt="Preview" style="display: none; max-width: 300px; max-height: 300px; margin-top: 10px;">
                        </div>
                        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Tambah Produk</button>

      </div>
                    </form>
                </div>
      </div>
     
    </div>
  </div>
</div>
@push('script')
<script>
    function previewImage(event) {
        const imgPreview = document.getElementById('imgPreview');
        imgPreview.style.display = 'block';

        const reader = new FileReader();
        reader.onload = function() {
            imgPreview.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    function validateForm() {
        const nama_produk = document.getElementById('nama_produk').value;
        const jenis_id = document.getElementById('jenis_id').value;
        const deskripsi = document.getElementById('deskripsi').value;
        const harga = document.getElementById('harga').value;

        if (nama_produk.trim() === '' || jenis_id === '' || deskripsi.trim() === '' || harga.trim() === '') {
            alert('Harap isi semua field sebelum mengirimkan form.');
            return false;
        }

        return true;
    }
</script>
@endpush