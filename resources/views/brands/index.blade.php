@extends('layouts.app')

@section('body')
<div class="container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold text-uppercase">Thương hiệu đối tác</h2>
        <p class="text-muted">Các thương hiệu giày chính hãng đang có mặt tại SOLID TECH</p>
    </div>

    <div class="row g-4">
        @foreach($brands as $brand)
            <div class="col-6 col-md-4 col-lg-3">
                <a href="{{ route('brands.show', $brand->slug) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm brand-card text-center py-4">
                        <div class="card-body d-flex flex-column align-items-center justify-content-center">
                            <div class="brand-logo mb-3 d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 80px; height: 80px;">
                                <i class="bi bi-tag-fill fs-1 text-secondary"></i>
                            </div>
                            
                            <h5 class="fw-bold text-dark text-uppercase m-0">{{ $brand->name }}</h5>
                            <span class="text-muted small mt-2">Xem sản phẩm <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</div>

<style>
    .brand-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .brand-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
        background-color: #f8f9fa;
    }
    .brand-card:hover .text-dark {
        color: #ee4d2d !important;
    }
</style>
@endsection