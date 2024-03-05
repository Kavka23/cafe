@extends('layout.app')
@section('contents')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi Kasir</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center; /* Center aligning the contents */
        }
        h3 {
            color: #333;
            text-align: center;
            margin-bottom: 20px; /* Adding space between each section */
        }
        p {
            color: #666;
            line-height: 1.6;
            text-align: justify; /* Justify text alignment for better readability */
            margin-bottom: 20px; /* Adding space between each section */
        }
        img {
            display: block;
            margin: 20px auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 100%;
            height: auto;
            animation: fadeIn 1s ease-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        /* CSS for image animation */
img {
    display: block;
    margin: 20px auto;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 100%;
    height: auto;
    animation: fadeIn 1s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h3>
            <button class="toggle-btn" onclick="toggleContent('tentang')">Tentang Aplikasi</button>
        </h3>
        <p id="tentang" style="display: none;">Aplikasi ini dapat digunakan atau dipakai sebagai aplikasi POST ataupun Kasir</p>
        <img src="kasir.png" alt="Aplikasi Kasir" width="400">
        
        <h3>
            <button class="toggle-btn" onclick="toggleContent('layanan')">Layanan Aplikasi</button>

        </h3>
        <p id="layanan" style="display: none;">Layanan aplikasi kasir adalah solusi perangkat lunak yang dirancang untuk mempermudah 
            proses transaksi keuangan di berbagai jenis bisnis, mulai dari toko retail kecil hingga
            rantai restoran besar. Aplikasi ini menyediakan berbagai fitur yang memungkinkan
            pengguna untuk mengelola inventaris, melakukan penjualan, melacak pendapatan, 
            melaksanakan tugas-tugas administratif terkait keuangan dengan lebih efisien.</p>
            <img src="layanan.jpg" alt="Aplikasi Kasir" width="400">
        
        
        <h3>
            <button class="toggle-btn" onclick="toggleContent('sejarah')">Sejarah Pembuatan</button>
        </h3>
        <p id="sejarah" style="display: none;">Sejarah Pembuatan aplikasi ini ketika saya SMK saat itu saya bersekolah di SMKN 1 Cianjur yang dimana saya akan Menghadapi Ujikom</p>
        <img src="siswa.jpg" alt="Sejarah Pembuatan" width="400">
    </div>

    <script>
        function toggleContent(id) {
            var x = document.getElementById(id);
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
</body>
</html>
@endsection
