@extends('layouts.app')

@section('body')
<div class="container py-5">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-dark">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $categoryName }}</li>
        </ol>
    </nav>

    <div class="d-flex align-items-center justify-content-between mb-4 border-bottom pb-2">
        <h2 class="fw-bold text-uppercase m-0">{{ $categoryName }}</h2>
        <span class="text-muted small">Hiển thị {{ $products->count() }} sản phẩm</span>
    </div>

    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-6 col-md-4 col-lg-3">
                @include('partials.product_card', ['product' => $product])
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <div class="mb-3">
                    <i class="bi bi-box-seam fs-1 text-secondary"></i>
                </div>
                <h4>Chưa có sản phẩm nào</h4>
                <p>Vui lòng quay lại sau hoặc xem các danh mục khác.</p>
                <a href="/" class="btn btn-dark rounded-0 mt-2">Về trang chủ</a>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }} 
        </div>
</div>
@endsection