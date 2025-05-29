@extends('layouts.master')

@section('title', 'Detail Customer')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-user-circle me-2"></i>Detail Customer - {{ $customer->nama_customer }}
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
                                    <th width="30%" class="text-muted fw-normal py-3">Kode Customer</th>
                                    <td class="py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                            <i class="fas fa-key text-primary me-2"></i>{{ $customer->kode_customer }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Nama Customer</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-user text-muted me-2"></i>{{ $customer->nama_customer }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Email</th>
                                    <td class="py-3">
                                        <i class="fas fa-envelope text-muted me-2"></i>{{ $customer->email ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">No. Telepon</th>
                                    <td class="py-3">
                                        <i class="fas fa-phone-alt text-muted me-2"></i>{{ $customer->no_telp ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Alamat</th>
                                    <td class="py-3">
                                        <i class="fas fa-home-alt text-muted me-2"></i>{{ $customer->alamat ?? '-' }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Tanggal Dibuat</th>
                                    <td class="py-3">
                                        <i class="far fa-calendar-alt text-muted me-2"></i>{{ $customer->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-normal py-3">Terakhir Diupdate</th>
                                    <td class="py-3">
                                        <i class="far fa-clock text-muted me-2"></i>{{ $customer->updated_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-cog me-2"></i>Aksi
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-3">
                                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-outline-warning rounded-pill text-start">
                                    <i class="fas fa-edit me-2"></i> Edit Data Customer
                                </a>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-pill text-start" onclick="return confirm('Apakah Anda yakin ingin menghapus customer ini?')">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Customer
                                    </button>
                                </form>
                                <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary rounded-pill text-start">
                                    <i class="fas fa-arrow-left me-2"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
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
    
    .table-borderless tbody tr:last-child {
        border-bottom: none;
    }
    
    .table th {
        font-weight: 500;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    
    .btn-outline-light:hover {
        color: #0ea5e9 !important;
    }
    
    .btn-outline-warning {
        border-color: #ffc107;
        color: #ffc107;
    }
    
    .btn-outline-warning:hover {
        background-color: #ffc107;
        color: #fff;
    }
    
    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }
    
    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: #fff;
    }
    
    .badge {
        font-weight: 500;
        padding: 0.35em 0.75em;
    }
</style>
@endpush