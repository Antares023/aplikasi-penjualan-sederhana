<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'orderDetails.product'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_customer' => 'required|exists:customers,kode',
            'items' => 'required|array|min:1',
            'items.*.kode_produk' => 'required|exists:products,kode',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        return DB::transaction(function () use ($request) {
            // Hitung total amount
            $totalAmount = collect($request->items)->sum(function ($item) {
                return $item['quantity'] * $item['unit_price'];
            });

            // Buat order
            $order = Order::create([
                'kode_customer' => $request->kode_customer,
                'total_amount' => $totalAmount,
                'status' => 'pending'
            ]);

            // Buat order details
            foreach ($request->items as $item) {
                $order->orderDetails()->create([
                    'kode_produk' => $item['kode_produk'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'subtotal' => $item['quantity'] * $item['unit_price']
                ]);
            }

            return redirect()->route('orders.show', $order->id)
                ->with('success', 'Order created successfully');
        });
    }

            public function edit(Order $order)
        {
            // Pastikan order bisa diedit hanya jika statusnya pending
            if ($order->status != 'pending') {
                return redirect()->route('orders.show', $order->id)
                    ->with('error', 'Order hanya bisa diedit ketika status pending');
            }

            $customers = Customer::all();
            $products = Product::all();
            $order->load('orderDetails');
            
            return view('orders.edit', compact('order', 'customers', 'products'));
        }

        public function update(Request $request, Order $order)
        {
            // Validasi sama seperti store
            $request->validate([
                'kode_customer' => 'required|exists:customers,kode',
                'items' => 'required|array|min:1',
                'items.*.kode_produk' => 'required|exists:products,kode',
                'items.*.quantity' => 'required|integer|min:1',
                'items.*.unit_price' => 'required|numeric|min:0',
            ]);

            return DB::transaction(function () use ($request, $order) {
                // Hapus semua order details yang ada
                $order->orderDetails()->delete();

                // Hitung total amount baru
                $totalAmount = collect($request->items)->sum(function ($item) {
                    return $item['quantity'] * $item['unit_price'];
                });

                // Update order
                $order->update([
                    'kode_customer' => $request->kode_customer,
                    'total_amount' => $totalAmount
                ]);

                // Buat order details baru
                foreach ($request->items as $item) {
                    $order->orderDetails()->create([
                        'kode_produk' => $item['kode_produk'],
                        'quantity' => $item['quantity'],
                        'unit_price' => $item['unit_price'],
                        'subtotal' => $item['quantity'] * $item['unit_price']
                    ]);
                }

                return redirect()->route('orders.show', $order->id)
                    ->with('success', 'Order updated successfully');
            });
        }

    public function show(Order $order)
    {
        $order->load(['customer', 'orderDetails.product']);
        return view('orders.show', compact('order'));
    }
}