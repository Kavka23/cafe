<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Titipan</title>
</head>
<body>
    <h1>Data Produk Titipan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Nama Supplier</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Keterangan</th>


                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
            </tr>
        </thead>
        <tbody>
            @foreach($produkTitipan as $pt)
            <tr>
            
                    <td>{{ $pt->id }}</td>
                    <td>{{ $pt->nama_produk }}</td> 
                    <td>{{ $pt->nama_supplier }}</td>
                    <td>{{ $pt->harga_beli	 }}</td>
                    <td>{{ $pt->harga_jual }}</td>
                    <td>{{ $pt->stok }} </td>
                    <td>{{ $pt->keterangan }}</td>

                <!-- Tambahkan kolom lainnya sesuai kebutuhan -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
