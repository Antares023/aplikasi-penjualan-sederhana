@extends('layouts.master')

@section('title', 'Detail Order')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card animate__animated animate__fadeIn">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Detail Order: {{ $order->order_number }}</h5>
                    <div>
                        @if($order->status == 'pending')
                        <a href="{{ route('orders.edit', $order->id) }}" class="btn btn-warning me-2">
                            <i class="fas fa-edit me-2"></i>Edit Order
                        </a>
                        @endif
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Informasi Customer</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Kode:</strong><br>
                                                {{ $order->kode_customer }}
                                            </p>
                                            <p class="mb-2">
                                                <strong>Nama:</strong><br>
                                                {{ $order->customer->nama }}
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Alamat:</strong><br>
                                                {{ $order->customer->alamat }}
                                            </p>
                                            <p class="mb-0">
                                                <strong>Telepon:</strong><br>
                                                {{ $order->customer->telepon }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Informasi Order</h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Tanggal:</strong><br>
                                                {{ $order->order_date->format('d/m/Y') }}
                                            </p>
                                            <p class="mb-2">
                                                <strong>Status:</strong><br>
                                                <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'cancelled' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst($order->status) }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2">
                                                <strong>Total Amount:</strong><br>
                                                Rp {{ number_format($order->total_amount, 2) }}
                                            </p>
                                            <p class="mb-0">
                                                <strong>Catatan:</strong><br>
                                                {{ $order->notes ?? '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <h5 class="mb-3">Daftar Produk</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Nama Produk</th>
                                    <th>Quantity</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderDetails as $detail)
                                <tr>
                                    <td>{{ $detail->kode_produk }}</td>
                                    <td>{{ $detail->product->nama }}</td>
                                    <td>{{ $detail->quantity }}</td>
                                    <td>Rp {{ number_format($detail->unit_price, 2) }}</td>
                                    <td>Rp {{ number_format($detail->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-end">Total</td>
                                    <td>Rp {{ number_format($order->total_amount, 2) }}</td>
                                </tr>
                                @if($order->discount_amount > 0)
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-end">Diskon</td>
                                    <td>- Rp {{ number_format($order->discount_amount, 2) }}</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td colspan="4" class="text-end">Grand Total</td>
                                    <td>Rp {{ number_format($order->total_amount - $order->discount_amount, 2) }}</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-end mt-4">
                        <button class="btn btn-success me-2">
                            <i class="fas fa-print me-2"></i>Cetak Invoice
                        </button>
                        @if($order->status == 'pending')
                        <button class="btn btn-primary">
                            <i class="fas fa-check me-2"></i>Proses Order
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection