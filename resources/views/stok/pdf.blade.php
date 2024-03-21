<!DOCTYPE html>
<html>
<head>
    <title>Daftar Stok</title>
    <style>
        /* Define CSS styles for your PDF here */
    </style>
</head>
<body>
    <h1>Daftar Stok</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Produk</th>
                <th>Stok</th>

              


                
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($stokData as $index => $stok)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $stok->products->nama_produk}}</td>
                <td>{{ $stok->stok }}</td>

              

                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
