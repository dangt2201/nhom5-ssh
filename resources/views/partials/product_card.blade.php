<div class="card h-100 border-0 shadow-sm product-card">
    
    <div class="img-box">
        <a href="#">
            <img src="{{ $product->img_thumbnail }}" 
                 class="card-img-top product-img" 
                 alt="{{ $product->name }}"
                 onerror="this.src='https://placehold.co/300x300?text=No+Image'">
        </a>
        
        @if($product->price_sale)
            <span class="badge bg-danger position-absolute top-0 start-0 m-3 rounded-0">
                -{{ round((($product->price - $product->price_sale) / $product->price) * 100) }}%
            </span>
        @endif

        <div class="action-buttons">
            <button class="btn btn-dark btn-sm rounded-circle me-1" title="Thêm vào giỏ">
                <i class="bi bi-cart-plus"></i>
            </button>
            <a href="{{ route('shop.detail', $product->slug) }}" class="btn btn-outline-dark btn-sm rounded-circle" title="Xem chi tiết">
                <i class="bi bi-eye"></i>
            </a>
        </div>
    </div>
    
    <div class="card-body text-center p-2">
        <div class="text-muted small text-uppercase mb-1">{{ $product->brand->name ?? 'Hãng' }}</div>
        
        <h6 class="card-title text-truncate mb-2">
            <a href="#" class="text-decoration-none text-dark fw-bold" title="{{ $product->name }}">
                {{ $product->name }}
            </a>
        </h6>
        
        <div class="price-box">
            @if($product->price_sale)
                <span class="text-danger fw-bold">{{ number_format($product->price_sale) }}đ</span>
                <span class="text-muted text-decoration-line-through small ms-1">{{ number_format($product->price) }}đ</span>
            @else
                <span class="fw-bold text-dark">{{ number_format($product->price) }}đ</span>
            @endif
        </div>
    </div>
</div>