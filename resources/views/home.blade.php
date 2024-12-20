<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Mengatur font Logistik agar menggunakan Arial dan Bold */
        h1.display-4 {
            font-family: Arial, sans-serif;
            font-weight: bold;
        }

        /* Menambahkan efek hover pada tombol Masuk */
        .btn-primary {
            background-color: #007bff;
            color: white;
            border-radius: 5px;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        /* Menambahkan gaya untuk memastikan gambar mengisi seluruh kolom kiri */
        .image-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Menambahkan padding untuk kolom kanan */
        .text-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            padding: 30px;
            height: 100vh;
        }

        /* Mengubah latar belakang menjadi abu-abu */
        body {
            background-color: #f4f4f4;
            /* Warna abu-abu muda */
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="container-fluid p-0">
        <div class="row g-0">
            <div class="col-md-6 p-0 image-container">
                <img src="{{ asset('img/1.jpg') }}" alt="Background Image">
            </div>
            <div class="col-md-6 text-container text-center">
                <h2 class="text-secondary text-bold">Selamat Datang di aplikasi </h2>
                <h1 class="display-4 mb-4">Logistik</h1>
                <a href="{{ route('barang_masuk.index') }}" class="btn btn-primary btn-lg">Masuk</a>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>

</html>
