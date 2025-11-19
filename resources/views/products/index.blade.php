@extends('layouts.app')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-5 text-primary fw-bold">Daftar Produk Ikan Asin</h1>
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
    @forelse($products as $p)
        <div class="col">
            <!-- Tambah "position-relative" di sini biar badge bisa nempel di pojok -->
            <div class="card h-100 text-white shadow position-relative">

                <!-- Badge Stok Habis / Hampir Habis -->
                @if($p->stock <= 0)
                    <span class="badge bg-danger fs-6 position-absolute top-0 end-0 m-3 z-3 shadow">
                        STOK HABIS
                    </span>
                @elseif($p->stock < 5)
                    <span class="badge bg-warning text-dark fs-6 position-absolute top-0 end-0 m-3 z-3 shadow">
                        Hampir Habis ({{ $p->stock }} kg)
                    </span>
                @endif

                <!-- Foto Produk -->
                @if($p->image)
                    <img src="{{ Storage::url($p->image) }}" class="card-img-top" style="height: 260px; object-fit: cover;">
                @else
                    <div class="bg-secondary d-flex align-items-center justify-content-center" style="height: 260px;">
                        <h1>Ikan</h1>
                    </div>
                @endif

                <!-- Isi Card -->
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title text-primary">{{ $p->name }}</h5>
                    <p class="card-text small flex-grow-1">{{ Str::limit($p->description, 80) }}</p>

                    <div class="mt-auto">
                        <h4 class="text-warning fw-bold">
                            Rp {{ number_format($p->price, 0, ',', '.') }} <small class="text-white">/ kg</small>
                        </h4>
                        <p class="mb-0 text-success fs-5">
                            Tersedia: <strong>{{ $p->stock }} kg</strong>
                        </p>
                    </div>
                </div>

                <!-- Tombol Edit & Hapus -->
                <div class="card-footer bg-transparent border-0">
                    <div class="btn-group w-100" role="group">

                        <!-- Tombol Tambah Stok (selalu ada) -->
                        <a href="{{ route('products.addStock', $p) }}" class="btn btn-info btn-sm">
                            + Stok
                        </a>

                        <!-- Tombol Pesan (hanya kalau stok > 0) -->
                        @if($p->stock > 0)
                            <a href="{{ route('order.create', $p) }}" class="btn btn-success btn-sm">
                                Pesan
                            </a>
                        @else
                            <button class="btn btn-secondary btn-sm" disabled>Stok Habis</button>
                        @endif

                        <!-- Edit & Hapus -->
                        <a href="{{ route('products.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('products.destroy', $p) }}" method="POST" class="d-inline m-0">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center py-5">
            <h3 class="text-white">Belum ada produk ikan asin</h3>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-lg mt-3">+ Tambah Produk Pertama</a>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center mt-5">
    {{ $products->links('pagination::bootstrap-5') }}
</div>
@endsection
