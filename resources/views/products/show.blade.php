@extends('layouts.app')
@section('content')
<div class="text-center py-5">
    <h1 class="text-success display-4">Pesanan Berhasil!</h1>
    <p>Terima kasih sudah beli di Toko Ikan Asin Pak Gatot</p>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card bg-dark text-white">
            <div class="card-body">
                <h3>Detail Pesanan #{{ $order->id }}</h3>
                <hr>
                <p><strong>Nama:</strong> {{ $order->customer_name }}</p>
                <p><strong>WA:</strong> {{ $order->phone }}</p>
                @if($order->address)<p><strong>Alamat:</strong> {{ $order->address }}</p>@endif
                <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>

                <table class="table table-dark mt-4">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Harga/kg</th>
                            <th>Jumlah</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>Rp {{ number_format($item->price_per_kg) }}</td>
                            <td>{{ $item->quantity_kg }} kg</td>
                            <td>Rp {{ number_format($item->subtotal) }}</td>
                        </tr>
                        @endforeach
                        <tr class="table-success">
                            <td colspan="3" class="text-end fw-bold">TOTAL</td>
                            <td class="fw-bold">Rp {{ number_format($order->total) }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="text-center mt-4">
                    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg">Kembali Belanja</a>
                    <a href="{{ route('orders.index') }}" class="btn btn-info btn-lg">Lihat Semua Pesanan</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
