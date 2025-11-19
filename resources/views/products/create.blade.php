@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card bg-dark text-white shadow-lg border-0">
            <div class="card-header bg-primary text-center py-4">
                <h3 class="mb-0 fw-bold">Tambah Produk Ikan Asin Baru</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Deskripsi (opsional)</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Harga per Kg (Rp)</label>
                            <input type="number" name="price" class="form-control form-control-lg"
                                value="{{ old('price', $product->price ?? '') }}"
                                step="500" required>
                            <small class="text-muted">Contoh: 85000</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stok Tersedia (Kg)</label>
                            <input type="number" name="stock" class="form-control form-control-lg"
                                value="{{ old('stock', $product->stock ?? '0') }}"
                                step="0.01" required>
                            <small class="text-muted">Bisa pakai koma, misal: 12.5</small>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Foto Produk</label>
                        <input type="file" name="image" class="form-control form-control-lg" accept="image/*">
                        <small class="text-muted">Format: jpg, jpeg, png, webp (max 2MB)</small>
                    </div>

                    <div class="d-grid d-md-flex justify-content-end gap-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
