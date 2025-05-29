@extends('layouts.master')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-boxes me-2"></i>Daftar Produk
                </h5>
                @if(auth()->user()->level == 'admin')
                <a href="{{ route('products.create') }}" class="btn btn-light btn-sm rounded-pill">
                    <i class="fas fa-plus-circle me-1"></i> Tambah Baru
                </a>
                @endif
            </div>
        </div>
        
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded" role="alert">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive rounded-3 overflow-hidden">
                <table class="table table-hover align-middle mb-0 bg-white">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="fw-semibold text-center">No</th>
                            <th class="fw-semibold text-center">Kode</th>
                            <th class="fw-semibold text-center">Merek</th>
                            <th class="fw-semibold text-center">Nama Produk</th>
                            <th class="fw-semibold text-center">Stok</th>
                            <th class="fw-semibold text-center">Harga</th>
                            <th class="fw-semibold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr class="border-bottom">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">
                                <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                    {{ $product->kode_produk }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $product->merek_produk > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $product->stok > 0 ? 'success' : 'danger' }} rounded-pill px-3 py-1">
                                    {{ $product->merek_produk }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0">{{ $product->nama_produk }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $product->stok > 0 ? 'success' : 'danger' }} rounded-pill px-3 py-1">
                                    {{ $product->stok }}
                                </span>
                            </td>
                            <td class="fw-semibold text-center">Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-info rounded-start" data-bs-toggle="tooltip">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(auth()->user()->level == 'admin')
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-end" data-bs-toggle="tooltip" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="fas fa-box-open text-muted fa-3x mb-3"></i>
                                    <h6 class="fw-semibold text-muted">Belum ada data produk</h6>
                                    <a href="{{ route('products.create') }}" class="btn btn-sm btn-primary mt-2 rounded-pill">
                                        <i class="fas fa-plus me-1"></i> Tambah Produk
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($products->hasPages())
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="text-muted small">
                    Menampilkan <span class="fw-semibold">{{ $products->firstItem() }}</span> sampai 
                    <span class="fw-semibold">{{ $products->lastItem() }}</span> dari 
                    <span class="fw-semibold">{{ $products->total() }}</span> produk
                </div>
                <div>
                    {{ $products->links('pagination::bootstrap-5') }}
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border-radius: 12px;
        overflow: hidden;
        border: none;
    }
    
    .card-header {
        border-bottom: none;
        padding: 1.25rem 1.5rem;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0ea5e9, #6366f1);
    }
    
    .table th {
        padding: 1rem 1.5rem;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }
    
    .table td {
        padding: 1rem 1.5rem;
        vertical-align: middle;
    }
    
    .avatar {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .avatar-sm {
        width: 36px;
        height: 36px;
    }
    
    .btn-group .btn {
        border-radius: 0;
    }
    
    .btn-group .btn:first-child {
        border-top-left-radius: 6px;
        border-bottom-left-radius: 6px;
    }
    
    .btn-group .btn:last-child {
        border-top-right-radius: 6px;
        border-bottom-right-radius: 6px;
    }
    
    .empty-state {
        padding: 3rem 0;
    }

    .table thead {
    background-color: #0ea5e9; /* Warna background header */
    }

    .table thead th {
        color: white !important; /* Warna teks putih */
        border-bottom: none; /* Hapus border bawah */
    }

    /* Untuk hover pada header jika diperlukan */
    .table thead th:hover {
        background-color: #0c8fd1;
    }
</style>
@endpush

@push('scripts')
<script>
    // Inisialisasi tooltip
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    })
</script>
@endpush