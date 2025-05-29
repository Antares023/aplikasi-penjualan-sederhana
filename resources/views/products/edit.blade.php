@extends('layouts.master')

@section('title', 'Edit Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-edit me-2"></i>Edit Produk - {{ $product->nama_produk }}
                </h5>
            </div>
        </div>
        
        <div class="card-body p-4">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="kode_produk" class="form-label fw-semibold text-muted">Kode Produk</label>
                            <input type="text" class="form-control rounded-lg bg-light" id="kode_produk" name="kode_produk" 
                                   value="{{ old('kode_produk', $product->kode_produk) }}" readonly>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merek_produk" class="form-label fw-semibold text-muted">Merek Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-lg" id="merek_produk" name="merek_produk" 
                                   value="{{ old('merek_produk', $product->merek_produk) }}" required>
                            @error('merek_produk')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_produk" class="form-label fw-semibold text-muted">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control rounded-lg" id="nama_produk" name="nama_produk" 
                                   value="{{ old('nama_produk', $product->nama_produk) }}" required>
                            @error('nama_produk')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stok" class="form-label fw-semibold text-muted">Stok <span class="text-danger">*</span></label>
                            <input type="number" class="form-control rounded-lg" id="stok" name="stok" 
                                   value="{{ old('stok', $product->stok) }}" min="0" required>
                            @error('stok')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga" class="form-label fw-semibold text-muted">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text rounded-start">Rp</span>
                                <input type="number" class="form-control rounded-end" id="harga" name="harga" 
                                       value="{{ old('harga', $product->harga) }}" min="0" required>
                            </div>
                            @error('harga')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="foto" class="form-label fw-semibold text-muted">Foto Produk <span class="text-danger">*</span></label>
                            <input type="file" class="form-control rounded-lg" id="foto" name="foto" 
                                   value="{{ old('foto', $product->foto) }}" required>
                            @error('foto')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex justify-content-end gap-3 mt-4">
                            <a href="{{ route('products.index', $product->id) }}" class="btn btn-outline-secondary rounded-pill px-4">
                                <i class="fas fa-times me-1"></i> Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection