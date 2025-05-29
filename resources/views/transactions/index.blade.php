@extends('layouts.master')

@section('title', 'Daftar Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-right-left me-2"></i>Daftar Transaksi
                </h5>
                @if(auth()->user()->level == 'admin')
                <a href="{{ route('transactions.create') }}" class="btn btn-light btn-sm rounded-pill">
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

            <div class="d-flex justify-content-between mb-3">
                <div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-success dropdown-toggle btn-sm rounded-pill" data-bs-toggle="dropdown">
                            <i class="fas fa-file-pdf me-2"></i>Download Laporan
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('transactions.pdf') }}">Semua Transaksi</a></li>
                            <li><a class="dropdown-item" href="{{ route('transactions.pdf', ['status' => 'pending']) }}">Pending</a></li>
                            <li><a class="dropdown-item" href="{{ route('transactions.pdf', ['status' => 'done']) }}">Selesai</a></li>
                        </ul>
                    </div>
                </div>
                
                <!-- Tambahkan form pencarian di sini -->
                <div class="col-md-4">
                    <form action="{{ route('transactions.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" 
                                name="search" 
                                class="form-control form-control-sm rounded-pill" 
                                placeholder="Cari kode transaksi atau kode customer..."
                                value="{{ request('search') }}">
                            <button type="submit" class="btn btn-primary btn-sm rounded-pill ms-2">
                                <i class="fas fa-search"></i>
                            </button>
                            @if(request('search'))
                                <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill ms-2">
                                    <i class="fas fa-times"></i> Reset
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive rounded-3 overflow-hidden">
                <div class="table-wrapper" style="overflow-x: auto; white-space: nowrap;">
                    <table class="table table-hover align-middle mb-0 bg-white">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="fw-semibold text-center">No</th>
                                <th class="fw-semibold text-center">Kode</th>
                                <th class="fw-semibold text-center">Customer</th>
                                <th class="fw-semibold text-center">Produk</th>
                                <th class="fw-semibold text-center">Quantity</th>
                                <th class="fw-semibold text-center">Total Harga</th>
                                <th class="fw-semibold text-center">Status</th>
                                <th class="fw-semibold text-center">Tanggal</th>
                                <th class="fw-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                            <tr class="border-bottom">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                            {{ $transaction->kode_transaksi }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <span class="d-flex align-items-center">
                                        <small>
                                            {{ $transaction->kode_customer }}
                                        </small>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">
                                                <small>
                                                    {{ $transaction->kode_produk ?? '-'}}
                                                </small>
                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $quantity = $transaction->quantity ?? 0;
                                        $badgeClass = $quantity > 0 ? 'bg-success' : 'bg-danger';
                                        $textClass = $quantity > 0 ? 'success' : 'danger';
                                    @endphp
                                    <span class="badge {{ $badgeClass }} bg-opacity-10 text-{{ $textClass }} rounded-pill px-3 py-1">
                                        {{ $quantity }}
                                    </span>
                                </td>
                                <td class="fw-semibold text-center"><small>
                                    Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}
                                </small></td>
                                <td>
                                    <span class="badge {{ $transaction->status == 'done' ? 'bg-success' : 'bg-danger' }} text-white rounded-pill px-3 py-1">
                                        <i class="fas {{ $transaction->status == 'done' ? 'fa-check' : 'fa-clock' }} me-1"></i>{{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if($transaction->tanggal_dibayar)
                                        <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-1">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ $transaction->tanggal_dibayar->format('d/m/Y') }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill px-3 py-1">
                                            <i class="far fa-clock me-1"></i>
                                            Belum dibayar
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($transaction->status == 'done')
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                            <i class="fas fa-check-circle me-1"></i> Transaksi Selesai
                                        </span>
                                    @elseif($transaction->quantity > 0)
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-sm btn-outline-info rounded-start" data-bs-toggle="tooltip">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('transactions.update-status', $transaction->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-outline-success rounded-end" data-bs-toggle="tooltip">
                                                <i class="fas fa-money-bill"></i>
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('transactions.show', $transaction->id) }}" class="btn btn-sm btn-outline-info rounded-start" data-bs-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            @if(auth()->user()->level == 'admin')
                                            <a href="{{ route('transactions.edit', $transaction->id) }}" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip">
                                                <i class="fas fa-cart-plus"></i>
                                            </a>
                                            <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger rounded-end" data-bs-toggle="tooltip" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <i class="fas fa-right-left text-muted fa-3x mb-3"></i>
                                        <h6 class="fw-semibold text-muted">Belum ada data transaksi</h6>
                                        <a href="{{ route('transactions.create') }}" class="btn btn-sm btn-primary mt-2 rounded-pill">
                                            <i class="fas fa-plus me-1"></i> Tambah Transaksi
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
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
    
    .rounded-circle {
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }
    
    .badge.bg-success {
        transition: all 0.3s ease;
    }
    
    .badge.bg-success:hover {
        transform: scale(1.05);
    }

    .table-wrapper {
    -webkit-overflow-scrolling: touch; /* Untuk scroll smooth di iOS */
    scrollbar-width: thin; /* Untuk Firefox */
    }

    /* Style scrollbar untuk Webkit browsers */
    .table-wrapper::-webkit-scrollbar {
        height: 8px;
    }

    .table-wrapper::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .table-wrapper::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .table-wrapper::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Untuk memastikan kolom header tetap sejajar dengan body */
    .table {
        margin-bottom: 0;
        width: auto;
        min-width: 100%;
    }

    /* Tambahan untuk tampilan mobile */
    @media (max-width: 767.98px) {
        .table-wrapper {
            border-left: 1px solid #dee2e6;
            border-right: 1px solid #dee2e6;
        }
        
        .table th, .table td {
            padding: 0.75rem;
            font-size: 0.875rem;
        }
    }

        .pagination {
        justify-content: flex-end;
        margin-top: 1rem;
    }

    .page-item.active .page-link {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
    }

    .page-link {
        color: #0ea5e9;
        border-radius: 50% !important;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
        border: none;
    }

    .page-link:hover {
        background-color: #f1f5f9;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi tooltip
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
        
        // Animasi ketika status berubah
        Livewire.on('statusUpdated', () => {
            const badge = document.querySelector('.badge.bg-success');
            if (badge) {
                badge.classList.add('animate__animated', 'animate__pulse');
                setTimeout(() => {
                    badge.classList.remove('animate__animated', 'animate__pulse');
                }, 1000);
            }
        });

        
    });
</script>
@endpush