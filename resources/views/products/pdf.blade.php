<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
    <style>
        /* Define CSS styles for your PDF here */
    </style>
</head>
<body>
    <h1>Daftar Produk</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>



                
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($productData as $index => $product)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $product->jenis->nama_jenis }}</td>
                <td>{{ $product->nama_produk }}</td>
                <td>{{ $product->deskripsi }}</td>
                <td>{{ $product->harga }}</td>

                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
