@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card bg-dark text-white shadow-lg">
            <div class="card-header bg-info text-center py-4">
                <h3>Tambah Stok: {{ $product->name }}</h3>
            </div>
            <div class="card-body p-5 text-center">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="rounded shadow mb-4" style="max-height: 250px;">
                @endif

                <h4 class="text-warning mb-3">
                    Rp {{ number_format($product->price, 0, ',', '.') }} / kg
                </h4>
                <p class="text-success fs-4 mb-4">
                    Stok saat ini: <strong>{{ $product->stock }} kg</strong>
                </p>

                <form action="{{ route('products.storeStock', $product) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label fw-bold fs-3">Tambah Berapa Kg?</label>
                        <input type="number" name="quantity" step="0.01" min="0.01" class="form-control form-control-lg text-center"
                               placeholder="Contoh: 15.5" required autofocus>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-info btn-lg fw-bold">
                            TAMBAH STOK SEKARANG
                        </button>
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
