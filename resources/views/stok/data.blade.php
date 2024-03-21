<div class="form-group mt-3">
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
        <thead class="table-primary">

                <tr>
                    <th>No</th>
                    <th>Produk</th>
                    <th>Stok</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody id="stokTableBody">
                @foreach ($stok as $s)
                <tr>
                    <td>{{ $i = !isset ($i) ? ($i = 1) : ++$i }}</td>
                    <td>{{ $s->products->nama_produk }}</td>
                    <td>{{ $s->stok }}</td>
                    <td>
                        <button class="btn btn-success" data-toggle="modal" data-target="#FormModalStok" 
                        data-mode="edit" data-id="{{$s->id}}" data-nama_produk="{{ $s->products->nama_produk }}" data-stok="{{ $s->stok }}">
                            <i class="fas fa-edit"></i>
                        </button>
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-delete"  data-id="{{ $s->id }}">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>