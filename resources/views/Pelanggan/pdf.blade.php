<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pelanggan</title>
    <style>
        /* Define CSS styles for your PDF here */
    </style>
</head>
<body>
    <h1>Daftar Pelanggan</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Email</th>
                <th>No Telp</th>
                <th>Alamat</th>
              


                
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($pelangganData as $index => $pelanggan)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pelanggan->nama_pelanggan }}</td>
                <td>{{ $pelanggan->email}}</td>
                <td>{{ $pelanggan->nomor_telepon}}</td>
                <td>{{ $pelanggan->alamat}}</td>


                
              

                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
