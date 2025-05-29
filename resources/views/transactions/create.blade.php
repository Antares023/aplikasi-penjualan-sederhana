@extends('layouts.master')

@section('title', 'Tambah Produk Baru')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Transaksi Baru
                </h5>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_transaksi" class="form-label fw-semibold text-muted">Kode Transaksi</label>
                            <input type="text" class="form-control rounded-lg" id="kode_transaksi" name="kode_transaksi" 
                                   value="{{ old('kode_transaksi') }}" placeholder="Kosongkan untuk generate otomatis">
                            @error('kode_transaksi')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_customer" class="form-label fw-semibold text-muted">Customer <span class="text-danger">*</span></label>
                            <select class="form-select" id="kode_customer" name="kode_customer" required>
                                <option value="">Pilih Customer</option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{ $customer->nama_customer }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-1"></i> Simpan Transaksi
                            </button>
                        </div>
                    </div>
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
        
        function calculateTotal() {
            const selectedProduct = productSelect.options[productSelect.selectedIndex];
            const harga = selectedProduct ? parseFloat(selectedProduct.getAttribute('data-harga')) : 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const total = harga * quantity;
            
            totalHargaInput.value = 'Rp ' + total.toLocaleString('id-ID');
            document.getElementById('hidden_total_harga').value = total; // Tambahkan ini
        }
        
        productSelect.addEventListener('change', calculateTotal);
        quantityInput.addEventListener('input', calculateTotal);
    });
</script>

@endsection