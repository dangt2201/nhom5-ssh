@extends('layouts.app')

@section('body')
<div class="container py-5">
    
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-dark">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}" class="text-decoration-none text-dark">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <img src="{{ $product->img_thumbnail }}" class="card-img-top" alt="{{ $product->name }}">
            </div>
        </div>

        <div class="col-md-6">
            <h1 class="fw-bold">{{ $product->name }}</h1>
            <div class="mb-3">
                <span class="badge bg-secondary me-2">{{ $product->brand->name }}</span>
                <span class="text-muted small">SKU: {{ $product->sku }}</span>
            </div>

            <div class="fs-3 mb-4">
                @if($product->price_sale)
                    <span class="text-danger fw-bold me-2">{{ number_format($product->price_sale) }}đ</span>
                    <span class="text-muted text-decoration-line-through fs-5">{{ number_format($product->price) }}đ</span>
                @else
                    <span class="fw-bold">{{ number_format($product->price) }}đ</span>
                @endif
            </div>

            <p class="text-muted mb-4">{{ $product->description }}</p>

            <form action="#" method="POST"> @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="mb-3">
                    <label class="fw-bold mb-2">Chọn Size:</label>
                    <div class="d-flex gap-2">
                        @foreach($product->variants->unique('size') as $variant)
                            <input type="radio" class="btn-check" name="size" id="size-{{ $variant->size }}" value="{{ $variant->size }}" autocomplete="off" {{ $loop->first ? 'checked' : '' }}>
                            <label class="btn btn-outline-dark rounded-0 px-3" for="size-{{ $variant->size }}">{{ $variant->size }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4">
                    <label class="fw-bold mb-2">Chọn Màu:</label>
                    <div class="d-flex gap-2">
                        @foreach($product->variants->unique('color') as $variant)
                            <input type="radio" class="btn-check" name="color" id="color-{{ $variant->color }}" value="{{ $variant->color }}" autocomplete="off" {{ $loop->first ? 'checked' : '' }}>
                            <label class="btn btn-outline-secondary rounded-0" for="color-{{ $variant->color }}">{{ $variant->color }}</label>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <input type="number" name="quantity" value="1" min="1" class="form-control text-center" style="width: 70px;">
                    <button type="submit" class="btn btn-dark rounded-0 flex-grow-1 text-uppercase fw-bold">
                        <i class="bi bi-cart-plus me-2"></i> Thêm vào giỏ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-5">
        <h3 class="fw-bold text-uppercase border-bottom pb-2 mb-4">Sản phẩm liên quan</h3>
        <div class="row">
            @foreach($relatedProducts as $related)
                <div class="col-6 col-md-3">
                    @include('partials.product_card', ['product' => $related])
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection