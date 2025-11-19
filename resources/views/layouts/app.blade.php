<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Toko Ikan Asin Bu Emaphp</title>

    <!-- Bootstrap 5 dari CDN (paling simpel) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <style>
        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            min-height: 100vh;
            color: #e2e8f0;
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar { background: #0f172a !important; }
        .card {
            background: #1e293b;
            border: none;
            border-radius: 16px;
            transition: 0.3s all;
            overflow: hidden;
        }
        .card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(14, 165, 233, 0.5) !important;
        }
        .btn-primary {
            background: linear-gradient(45deg, #0ea5e9, #38bdf8);
            border: none;
        }
        .btn-warning { background: #f97316; border: none; }
        .btn-danger { background: #ef4444; border: none; }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-lg sticky-top">
        <div class="container">
            <!-- Nama Toko -->
            <a class="navbar-brand fw-bold fs-3" href="{{ route('products.index') }}">
                Toko Ikan Asin Bu Ema
            </a>

            <!-- Tombol-tombol di kanan -->
            <div class="d-flex gap-3 align-items-center">
                <!-- Tombol Daftar Pesanan (BARU!) -->
                <a href="{{ route('orders.index') }}" class="btn btn-warning btn-lg position-relative">
                    Pesanan Masuk
                    <!-- Icon -->
                    @if(\App\Models\Order::where('status', 'pending')->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{\App\Models\Order::where('status', 'pending')->count()}}
                            <span class="visually-hidden">pesanan baru</span>
                        </span>
                    @endif
                </a>

                <!-- Tombol Tambah Produk Baru -->
                <a href="{{ route('products.create') }}" class="btn btn-info btn-lg">
                    + Produk Baru
                </a>
            </div>
        </div>
    </nav>

    <!-- Konten utama -->
    <div class="container py-5">
        <!-- Alert sukses -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Isi halaman -->
        @yield('content')
    </div>

</body>
</html>
