@extends('layouts.master')

@section('title', 'Detail Transaksi')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-box me-2"></i>Detail Transaksi - {{ $transaction->kode_transaksi }}
                </h5>
            </div>
        </div>
        
        <div class="card-body p-4">
            <div class="row">
                <div class="col-lg-8">
                    <div class="table-responsive">
                        <table class="table table-borderless">
                            <tbody>
                                <tr class="border-bottom">
                                    <th width="30%" class="text-muted fw-normal py-3">Kode Transaksi</th>
                                    <td class="py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                            <i class="fas fa-key text-primary me-2" ></i>{{ $transaction->kode_transaksi }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Kode Customer</th>
                                    <td class="py-3">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                            <i class="fas fa-box text-success me-2"></i>{{ $transaction->kode_customer }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Nama Customer</th>
                                    <td class="py-3">
                                        <span class="py-3 fw-semibold">
                                            <i class="fas fa-user text-muted me-2"></i>
                                            {{ $transaction->nama_customer ?? 'Tidak tersedia' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Kode Produk</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-box-open text-muted me-2"></i>{{ $transaction->kode_produk }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Quantity</th>
                                    <td class="py-3">
                                        <span class="badge {{ $transaction->quantity > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $transaction->quantity > 0 ? 'success' : 'danger' }} rounded-pill px-3 py-1">
                                            <i class="fas fa-boxes-stacked text-{{ $transaction->quantity > 0 ? 'success' : 'danger' }} me-2"></i>{{ $transaction->quantity }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Harga</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-coins text-muted me-2"></i>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4 mt-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-box me-2"></i>Tambah Produk - {{ $transaction->kode_transaksi }}
                </h5>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row g-4 mb-4"> 
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label fw-semibold text-muted">Customer</label>
                            <input type="text" class="form-control" name="kode_customer"
                                   value="{{ $transaction->kode_customer }}" readonly>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_produk" class="form-label fw-semibold text-muted">Produk <span class="text-danger">*</span></label>
                            <select class="form-select" id="kode_produk" name="kode_produk" required>
                                <option value="">Pilih Produk</option>
                                @foreach($products as $product)
                                <option value="{{ $product->kode_produk }}" 
                                    {{ $transaction->kode_produk == $product->kode_produk ? 'selected' : '' }}
                                    data-harga="{{ $product->harga }}">
                                    {{ $product->kode_produk }} - {{ $product->nama_produk }} (Rp {{ number_format($product->harga, 0, ',', '.') }})
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="quantity" class="form-label fw-semibold text-muted">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control rounded-lg" id="quantity" name="quantity" 
                                   value="{{ old('quantity', $transaction->quantity) }}" min="1" required>
                            @error('quantity')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_harga" class="form-label fw-semibold text-muted">Total Harga</label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start">Rp</span>
                                <input type="text" class="form-control rounded-end" id="total_harga" name ="total_harga" 
                                value="{{ $transaction->total_harga }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>

                @if($transaction->tanggal_dibayar)
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Transaksi ini telah dibayar pada: 
                            <strong>{{ $transaction->tanggal_dibayar->format('d/m/Y H:i') }}</strong>
                        </div>
                    </div>
                </div>
                @endif

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                        <i class="fas fa-arrow-left me-1"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const productSelect = document.getElementById('kode_produk');
        const quantityInput = document.getElementById('quantity');
        const totalHargaInput = document.getElementById('total_harga');
        const statusSelect = document.getElementById('status');
        
        function calculateTotal() {
            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            const harga = selectedProduct ? parseFloat(selectedProduct.getAttribute('data-harga')) : 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const total = harga * quantity;
            
            totalHargaInput.value = 'Rp ' + total.toLocaleString('id-ID');
        }
        
        productSelect.addEventListener('change', calculateTotal);
        quantityInput.addEventListener('input', calculateTotal);
        
        // Hitung awal saat halaman dimuat
        calculateTotal();
        
        // Konfirmasi jika mengubah status ke done
        statusSelect.addEventListener('change', function() {
            if (this.value === 'done') {
                if (!confirm('Apakah Anda yakin ingin menyelesaikan transaksi ini?')) {
                    this.value = 'pending';
                }
            }
        });
    });
</script>

@endsection