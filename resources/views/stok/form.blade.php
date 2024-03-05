<div class="modal fade" id="FormModalStok" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="card-body">
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="stok">
                    @csrf
                    <div class="form-group row">
                        <label for="products_id" class="col-sm-4 col-form-label">Produk</label>
                        <div class="col-sm-8">
                        <select name="products_id" id="products_id">
                                <option value="">Pilih</option>
                                @foreach ($products  as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama_produk }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div id="method"></div>
                    <div class="form-group row">
                        <label for="staticEmail" class="col-sm-4 col-form-label">Stok</label>
                        <div class="col-sm-8">
                        <input type="number" class="form-control" id="stok" value="" name="stok">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>