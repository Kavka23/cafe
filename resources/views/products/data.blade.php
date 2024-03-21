<div class="form-group mt-3">
        <input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Tools</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
                @if($product->count() > 0)
                @foreach($product as $rs)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $rs->nama_produk }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('products.show', $rs->id) }}" class="btn btn-secondary">Detail</a>
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#formModalProduk"
                                     data-mode="edit" data-id="{{ $rs->id }}" data-jenis_id="{{ $rs->jenis_id }}"
                                     data-nama_produk="{{ $rs->nama_produk }}" data-harga="{{ $rs->harga }}"
                                     data-deskripsi="{{ $rs->deskripsi }}">
                                     <i class="fas fa-edit"></i>
                                 </button> 
                                 <form method="post" action="{{ route('products.destroy', $rs->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn text-danger delete-data btn-delete" data-id="{{ $rs->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>                        
            </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3" class="text-center">Tidak ada data</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>