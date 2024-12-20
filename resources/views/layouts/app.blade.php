<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Logistik') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar-nav .nav-link {
            color: #fff;
            position: relative;
            padding-bottom: 5px;
            transition: color 0.3s, border 0.3s;
        }

        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 100%;
            background-color: #fff;
            transition: width 0.3s;
        }

        .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            height: 2px;
            width: 0;
            background-color: #fff;
            transition: width 0.3s;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #e6e6e6;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary border-bottom py-2">
        <div class="container">
            <a class="navbar-brand fs-3 fw-bold" href="{{ url('/') }}">
                {{ config('app.name', 'Logistik') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-bold {{ request()->routeIs('barang_masuk.index') ? 'active' : '' }}"
                            href="{{ route('barang_masuk.index') }}">Barang Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-bold {{ request()->routeIs('barang_keluar.index') ? 'active' : '' }}"
                            href="{{ route('barang_keluar.index') }}">Barang Keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5 fw-bold {{ request()->routeIs('stok.barang.index') ? 'active' : '' }}"
                            href="{{ route('stok.barang.index') }}">Stok Barang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <main class="py-4">
        <div class="container">
            @yield('content')
        </div>
    </main>
</body>

</html>
