@extends('layouts.master')

@section('title', 'Detail Produk')

@section('content')
<div class="container-fluid px-4">
    <div class="card animate__animated animate__fadeIn shadow-sm border-0">
        <div class="card-header bg-gradient-primary text-white">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="fas fa-box me-2"></i>Detail Produk - {{ $product->nama_produk }}
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
                                    <th width="30%" class="text-muted fw-normal py-3">Kode Produk</th>
                                    <td class="py-3">
                                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
                                            <i class="fas fa-key text-primary me-2" ></i>{{ $product->kode_produk }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Merek Produk</th>
                                    <td class="py-3">
                                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                            <i class="fas fa-box text-success me-2"></i>{{ $product->merek_produk }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Nama Produk</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-box-open text-muted me-2"></i>{{ $product->nama_produk }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Stok</th>
                                    <td class="py-3">
                                        <span class="badge {{ $product->stok > 0 ? 'bg-success' : 'bg-danger' }} bg-opacity-10 text-{{ $product->stok > 0 ? 'success' : 'danger' }} rounded-pill px-3 py-1">
                                            <i class="fas fa-boxes-stacked text-{{ $product->stok > 0 ? 'success' : 'danger' }} me-2"></i>{{ $product->stok }}
                                        </span>
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Harga</th>
                                    <td class="py-3 fw-semibold">
                                        <i class="fas fa-coins text-muted me-2"></i>Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    </td>
                                </tr>
                                <tr class="border-bottom">
                                    <th class="text-muted fw-normal py-3">Tanggal Dibuat</th>
                                    <td class="py-3">
                                        <i class="far fa-calendar-alt text-muted me-2"></i>{{ $product->created_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-muted fw-normal py-3">Terakhir Diupdate</th>
                                    <td class="py-3">
                                        <i class="far fa-clock text-muted me-2"></i>{{ $product->updated_at->format('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-image me-2"></i>Foto Produk
                            </h6>
                        </div>
                        <div class="card-body text-center">
                            @if ($product->foto)
                                <img src="{{ asset('storage/foto-product/'.$product->foto) }}" alt="Foto Produk" class="img-thumbnail">
                            @else
                                <img src="{{ asset('images/no-image.png') }}" alt="No Image" class="img-fluid rounded-3">
                            @endif
                        </div>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h6 class="mb-0 fw-semibold">
                                <i class="fas fa-cog me-2"></i>Aksi
                            </h6>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->level == 'admin')
                            <div class="d-grid gap-3">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-outline-warning rounded-pill text-start">
                                    <i class="fas fa-edit me-2"></i> Edit Data Produk
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger rounded-pill text-start" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash-alt me-2"></i> Hapus Produk
                                    </button>
                                </form>
                                @endif
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary rounded-pill text-start">
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