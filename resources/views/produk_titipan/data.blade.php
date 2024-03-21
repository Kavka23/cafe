<div class="form-group mt-3">
<input type="text" class="form-control" id="searchInput" placeholder="Cari produk...">
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-bordered table-hover">
        <thead class="table-primary">

                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Nama Supplier</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Stok</th>
                    <th>Keterangan</th>
                    <th>Tools</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produkTitipan as $pt)
                <tr>
                   
                    <td>{{ $pt->id }}</td>
                    <td>{{ $pt->nama_produk }}</td> 
                    <td>{{ $pt->nama_supplier }}</td>
                    <td>{{ $pt->harga_beli	 }}</td>
                    <td>{{ $pt->harga_jual }}</td>
                    <td>{{ $pt->stok }} </td>
                    <td>{{ $pt->keterangan }}</td>


                    <td>
                        <button class="btn btn-success" data-toggle="modal" data-target="#FormModalProdukTitipan" 
                        data-mode="edit" data-id="{{$pt->id}}" data-nama_produk="{{ $pt->nama_produk }}" data-nama_supplier="{{ $pt->nama_supplier }}"
                        data-harga_beli="{{ $pt->harga_beli }}"data-harga_jual="{{ $pt->harga_jual }}"data-stok="{{ $pt->stok }}"data-keterangan="{{ $pt->keterangan }}">
                            <i class="fas fa-edit"></i>
                            </button>
                            <form method="post" action="{{ route('produk_titipan.destroy', $pt->id) }}" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn text-danger delete-data btn-delete" data-id="{{ $pt->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>