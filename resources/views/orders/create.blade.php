@extends('layouts.master')

@section('title', 'Buat Order Baru')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        height: 42px;
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
    }
    .select2-container--default .select2-results__option--highlighted {
        background-color: var(--primary-500);
        color: white;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card animate__animated animate__fadeIn">
                <div class="card-header">
                    <h5 class="mb-0">Buat Order Baru</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                        @csrf
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kode_customer" class="form-label">Customer</label>
                                    <select class="form-select select2" id="kode_customer" name="kode_customer" required>
                                        <option value="">Pilih Customer</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->kode }}">{{ $customer->kode_customer }} - {{ $customer->nama_customer }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <h5 class="mb-3">Produk</h5>
                        <div id="product-container">
                            <div class="row product-item mb-3">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label class="form-label">Produk</label>
                                        <select class="form-select product-select" name="items[0][kode_produk]" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->kode }}" data-price="{{ $product->harga }}">
                                                    {{ $product->kode_produk }} - {{ $product->nama_produk }} (Rp {{ number_format($product->harga, 2) }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Quantity</label>
                                        <input type="number" class="form-control quantity" name="items[0][quantity]" min="1" value="1" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Harga Satuan</label>
                                            <input type="text" class="form-control unit-price" name="items[0][unit_price]" required> 
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Subtotal</label>
                                            <input type="text" class="form-control subtotal" readonly>
                                    </div>
                                </div>
                                <div class="col-md-1 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-product">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" id="add-product" class="btn btn-secondary mb-4">
                            <i class="fas fa-plus me-2"></i>Tambah Produk
                        </button>
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Total Amount</label>
                                    <input type="text" class="form-control" id="total-amount" name="total_amount" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Diskon (Rp)</label>
                                    <input type="number" class="form-control" id="discount-amount" name="discount_amount" min="0" value="0">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-label">Grand Total</label>
                                    <input type="text" class="form-control" id="grand-total" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mt-4">
                            <label for="notes" class="form-label">Catatan</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>
                        
                        <div class="d-flex justify-content-end mt-4">
                            <a href="{{ route('orders.index') }}" class="btn btn-light me-2">
                                <i class="fas fa-arrow-left me-2"></i>Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Simpan Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            placeholder: "Pilih Customer",
            allowClear: true
        });
        
        $('.product-select').select2({
            placeholder: "Pilih Produk",
            allowClear: true
        });
        
        let productIndex = 1;
        
        // Add new product row
        $('#add-product').click(function() {
            const newRow = `
                <div class="row product-item mb-3">
                    <div class="col-md-5">
                        <div class="form-group">
                            <select class="form-select product-select" name="items[${productIndex}][kode_produk]" required>
                                <option value="">Pilih Produk</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->kode }}" data-price="{{ $product->harga }}">
                                        {{ $product->kode }} - {{ $product->nama }} (Rp {{ number_format($product->harga, 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="number" class="form-control quantity" name="items[${productIndex}][quantity]" min="1" value="1" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control unit-price" name="items[${productIndex}][unit_price]" readonly>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <input type="text" class="form-control subtotal" readonly>
                        </div>
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-danger remove-product">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            $('#product-container').append(newRow);
            
            // Initialize Select2 for new row
            $('#product-container .product-select').last().select2({
                placeholder: "Pilih Produk",
                allowClear: true
            });
            
            productIndex++;
        });
        
        // Remove product row
        $(document).on('click', '.remove-product', function() {
            if($('.product-item').length > 1) {
                $(this).closest('.product-item').remove();
                calculateTotal();
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Minimal satu produk harus ada dalam order',
                });
            }
        });
        
        // Product select change
        $(document).on('change', '.product-select', function() {
            const price = $(this).find(':selected').data('price');
            $(this).closest('.product-item').find('.unit-price').val(price);
            calculateSubtotal($(this).closest('.product-item'));
            calculateTotal();
        });
        
        // Quantity change
        $(document).on('input', '.quantity', function() {
            calculateSubtotal($(this).closest('.product-item'));
            calculateTotal();
        });
        
        // Discount change
        $('#discount-amount').on('input', function() {
            calculateTotal();
        });
        
        // Calculate subtotal for a product item
        function calculateSubtotal(item) {
            const quantity = item.find('.quantity').val();
            const unitPrice = item.find('.unit-price').val();
            const subtotal = quantity * unitPrice;
            item.find('.subtotal').val(subtotal.toLocaleString('id-ID'));
        }
        
        // Calculate total amount
        function calculateTotal() {
            let total = 0;
            $('.product-item').each(function() {
                const subtotal = $(this).find('.subtotal').val().replace(/\./g, '');
                if(subtotal) {
                    total += parseFloat(subtotal);
                }
            });
            
            const discount = parseFloat($('#discount-amount').val()) || 0;
            const grandTotal = total - discount;
            
            $('#total-amount').val(total.toLocaleString('id-ID'));
            $('#grand-total').val(grandTotal.toLocaleString('id-ID'));
        }
        
        // Initialize calculation on page load
        calculateTotal();
    });
</script>
@endpush