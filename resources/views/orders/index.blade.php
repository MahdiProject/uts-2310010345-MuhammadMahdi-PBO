@extends('layouts.app')
@section('content')

<h1 class="text-center text-warning display-5 mb-4">
    Daftar Pesanan Masuk
    @if($pending = \App\Models\Order::where('status','pending')->count())
        <span class="badge bg-danger fs-4">{{ $pending }} BARU</span>
    @endif
</h1>
<!-- TOMBOL KEMBALI (BARU!) -->
    <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mb-4">
        ← Kembali ke Produk
    </a>
<div class="table-responsive">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Pelanggan</th>
                <th>Total</th>
                <th>Status</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $o)
            <tr>
                <td>#{{ $o->id }}</td>
                <td>{{ $o->customer_name }}<br><small>{{ $o->phone }}</small></td>
                <td>Rp {{ number_format($o->total) }}</td>
                <td><span class="badge bg-{{ $o->status == 'pending' ? 'warning' : 'success' }}">{{ strtoupper($o->status) }}</span></td>
                <td>{{ $o->created_at->format('d/m/Y') }}</td>
                <td>
                    <a href="{{ route('orders.show', $o) }}" class="btn btn-info btn-sm">Lihat</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
