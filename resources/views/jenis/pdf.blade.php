<!DOCTYPE html>
<html>
<head>
    <title>Daftar Jenis</title>
    <style>
        /* Define CSS styles for your PDF here */
    </style>
</head>
<body>
    <h1>Daftar Jenis</h1>
    <table border="1">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Jenis</th>
              


                
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            @foreach($jenisData as $index => $jenis)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $jenis->nama_jenis }}</td>
              

                <!-- Add more columns as needed -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
