@extends('layouts.master')

@section('title', 'Beranda')

@section('content')

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><strong>Dashboard</strong></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary shadow-sm">
                <i class="fas fa-share-alt me-1"></i> Share
            </button>
            <button type="button" class="btn btn-sm btn-outline-secondary shadow-sm">
                <i class="fas fa-download me-1"></i> Export
            </button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle shadow-sm">
            <i class="fas fa-calendar me-1"></i> This week
        </button>
    </div>
</div>

<div class="row mb-4">
    <!-- Total Customer Card -->
    <div class="col-md-3 mb-3">
        <div class="card border-start border-primary border-5 shadow-sm h-100 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Customer</h6>
                        <h2 class="mb-0">{{ $totalCustomers }}</h2>
                    </div>
                    <div class="bg-primary bg-opacity-10 p-3 rounded">
                        <i class="fas fa-users fa-2x text-primary"></i>
                    </div>
                </div>
                <hr class="my-2">
                <a href="{{ route('customers.index') }}" class="small text-primary text-decoration-none d-flex align-items-center">
                    View details <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Products Card -->
    <div class="col-md-3 mb-3">
        <div class="card border-start border-success border-5 shadow-sm h-100 animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Products</h6>
                        <h2 class="mb-0">{{ $totalProducts }}</h2>
                    </div>
                    <div class="bg-success bg-opacity-10 p-3 rounded">
                        <i class="fas fa-box fa-2x text-success"></i>
                    </div>
                </div>
                <hr class="my-2">
                <a href="{{ route('products.index') }}" class="small text-success text-decoration-none d-flex align-items-center">
                    View details <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Total Orders Card -->
    <div class="col-md-3 mb-3">
        <div class="card border-start border-warning border-5 shadow-sm h-100 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Total Transactions</h6>
                        <h2 class="mb-0">{{ $totalTransactions }}</h2>
                    </div>
                    <div class="bg-warning bg-opacity-10 p-3 rounded">
                        <i class="fas fa-shopping-cart fa-2x text-warning"></i>
                    </div>
                </div>
                <hr class="my-2">
                <a href="#" class="small text-warning text-decoration-none d-flex align-items-center">
                    View details <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Report Orders Card -->
    <div class="col-md-3 mb-3">
        <div class="card border-start border-danger border-5 shadow-sm h-100 animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted mb-2">Report Orders</h6>
                        <h2 class="mb-0">0</h2>
                    </div>
                    <div class="bg-danger bg-opacity-10 p-3 rounded">
                        <i class="fas fa-chart-bar fa-2x text-danger"></i>
                    </div>
                </div>
                <hr class="my-2">
                <a href="#" class="small text-danger text-decoration-none d-flex align-items-center">
                    View details <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 0.5rem;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .border-5 {
        border-width: 5px !important;
    }
</style>
@endpush