<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

// Redirect root ke produk
Route::get('/', function () {
    return redirect()->route('products.index');
});

// CRUD Produk
Route::resource('products', ProductController::class);

// Order Routes
Route::get('/order/{product}', [OrderController::class, 'create'])->name('order.create');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
// untuk menabahkan stok ikan yang udah habis
Route::get('/products/{product}/add-stock', [ProductController::class, 'addStock'])->name('products.addStock');
Route::post('/products/{product}/add-stock', [ProductController::class, 'storeStock'])->name('products.storeStock');
