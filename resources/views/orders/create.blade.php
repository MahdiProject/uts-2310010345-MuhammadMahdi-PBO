@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card bg-dark text-white shadow-lg">
            <div class="card-header bg-success text-center py-4">
                <h3>Pesan: {{ $product->name }}</h3>
            </div>
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    @if($product->image)
                        <img src="{{ Storage::url($product->image) }}" class="rounded shadow" style="max-height: 300px;">
                    @endif
                    <h4 class="mt-3 text-warning">Rp {{ number_format($product->price) }} / kg</h4>
                    <p class="text-success fs-4">Stok tersedia: {{ $product->stock }} kg</p>
                </div>

                <form action="{{ route('order.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Berapa Kg yang mau dibeli?</label>
                        <input type="number" name="quantity_kg" class="form-control form-control-lg text-center"
                               step="0.1" min="0.5" max="{{ $product->stock }}" value="1" required>
                    </div>

                    <hr class="text-white">

                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pembeli</label>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">No. HP / WA</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Pengiriman (opsional)</label>
                        <textarea name="address" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-success btn-lg">
                            KIRIM PESANAN SEKARANG
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
