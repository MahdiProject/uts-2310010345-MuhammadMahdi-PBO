<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function create(Product $product)
    {
        if ($product->stock <= 0) {
            return redirect()->route('products.index')->with('error', 'Stok habis!');
        }
        return view('orders.create', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity_kg' => 'required|numeric|min:0.5|max:100',
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Cek stok cukup
        if ($product->stock < $request->quantity_kg) {
            return back()->with('error', 'Stok tidak cukup! Tersedia: ' . $product->stock . ' kg');
        }

        $subtotal = $product->price * $request->quantity_kg;

        // Buat order
        $order = Order::create([
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'total' => $subtotal,
        ]);

        // Buat item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'product_name' => $product->name,
            'price_per_kg' => $product->price,
            'quantity_kg' => $request->quantity_kg,
            'subtotal' => $subtotal,
        ]);

        // Kurangi stok
        $product->decrement('stock', $request->quantity_kg);

        return redirect()->route('orders.show', $order)
                         ->with('success', 'Pesanan berhasil! Terima kasih sudah beli ikan asin kami');
    }
}
