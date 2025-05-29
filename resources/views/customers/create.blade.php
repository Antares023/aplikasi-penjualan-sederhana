@extends('layouts.master')

@section('title', 'Tambah Customer Baru')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-user-plus me-2"></i>Tambah Customer Baru
                </h5>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('customers.store') }}" method="POST">
                @csrf
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_customer" class="form-label fw-semibold text-muted">Kode Customer</label>
                            <input type="text" class="form-control rounded-lg" id="kode_customer" name="kode_customer" 
                                   value="{{ old('kode_customer') }}" placeholder="Kosongkan untuk generate otomatis">
                            @error('kode_customer')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_customer" class="form-label fw-semibold text-muted">Nama Customer <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-lg" id="nama_customer" name="nama_customer" 
                                   value="{{ old('nama_customer') }}" required>
                            @error('nama_customer')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email" class="form-label fw-semibold text-muted">Email</label>
                            <input type="email" class="form-control rounded-lg" id="email" name="email" 
                                   value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_telp" class="form-label fw-semibold text-muted">No. Telepon</label>
                            <input type="text" class="form-control rounded-lg" id="no_telp" name="no_telp" 
                                   value="{{ old('no_telp') }}">
                            @error('no_telp')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="form-group">
                            <label for="alamat" class="form-label fw-semibold text-muted">Alamat</label>
                            <textarea class="form-control rounded-lg" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('customers.index') }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-1"></i> Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </form>
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
    
    .form-control {
        border-radius: 8px;
        padding: 0.75rem 1rem;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #0ea5e9;
        box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.15);
    }
    
    .rounded-lg {
        border-radius: 8px;
    }
    
    .btn {
        border-radius: 50px;
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    
    .btn-primary {
        background-color: #0ea5e9;
        border-color: #0ea5e9;
    }
    
    .btn-primary:hover {
        background-color: #0c8fd1;
        border-color: #0c8fd1;
    }
    
    .form-label {
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
</style>
@endpush