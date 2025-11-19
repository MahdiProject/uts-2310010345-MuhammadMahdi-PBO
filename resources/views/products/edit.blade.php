@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card bg-dark text-white shadow-lg border-0">
            <div class="card-header bg-warning text-dark text-center py-4">
                <h3 class="mb-0 fw-bold">Edit Produk: {{ $product->name }}</h3>
            </div>
            <div class="card-body p-5">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="name" class="form-control form-control-lg"
                               value="{{ old('name', $product->name) }}" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Deskripsi (opsional)</label>
                        <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
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
                        <label class="form-label fw-bold">Foto Produk Saat Ini</label>
                        @if($product->image)
                            <div class="mb-3">
                                <img src="{{ Storage::url($product->image) }}" class="img-fluid rounded shadow" style="max-height: 250px;">
                            </div>
                        @else
                            <p class="text-muted">Belum ada foto</p>
                        @endif

                        <label class="form-label fw-bold">Ganti Foto (kosongkan jika tidak ingin ganti)</label>
                        <input type="file" name="image" class="form-control form-control-lg" accept="image/*">
                    </div>

                    <div class="d-grid d-md-flex justify-content-end gap-3">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">
                            Batal
                        </a>
                        <button type="submit" class="btn btn-warning btn-lg px-5 text-dark fw-bold">
                            Update Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
