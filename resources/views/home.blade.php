@extends('layouts.app')

@section('body')

<div class="position-relative mb-5">
    <img src="https://images.unsplash.com/photo-1556906781-9a412961c28c?q=80&w=2000&auto=format&fit=crop" 
         class="w-100" style="height: 500px; object-fit: cover; filter: brightness(0.7);" alt="Banner">
    
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white w-100">
        <h1 class="display-4 fw-bold text-uppercase mb-2">SOLID X TECH</h1>
        <p class="fs-5 mb-4">Bộ sưu tập mùa đông mới nhất 2025</p>
    </div>
</div>

<div class="container">

    <div class="text-center mb-5">
        <h3 class="fw-bold text-uppercase">SẢN PHẨM NỔI BẬT</h3>
        <div class="bg-dark mx-auto mt-2" style="width: 60px; height: 3px;"></div>
    </div>

    <div class="row g-4 mb-5">
        @foreach($hotProducts->take(4) as $product)
            <div class="col-6 col-md-3">
                @include('partials.product_card', ['product' => $product])
            </div>
        @endforeach
    </div>

    <div class="row g-3 mb-5">
        <div class="col-md-4">
            <div class="position-relative group-cat">
                <img src="https://images.unsplash.com/photo-1617137984095-74e4e5e3613f?q=80&w=800&auto=format&fit=crop" 
                     class="w-100" style="height: 400px; object-fit: cover;" alt="Nam">
                <a href="{{ route('shop.category', 'giay-nam') }}" class="btn btn-light rounded-0 position-absolute bottom-0 start-50 translate-middle-x mb-4 fw-bold px-4">
                    GIÀY NAM
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative group-cat">
                <img src="https://images.unsplash.com/photo-1543163521-1bf539c55dd2?q=80&w=800&auto=format&fit=crop" 
                     class="w-100" style="height: 400px; object-fit: cover;" alt="Nữ">
                <a href="{{ route('shop.category', 'giay-nu') }}" class="btn btn-light rounded-0 position-absolute bottom-0 start-50 translate-middle-x mb-4 fw-bold px-4">
                    GIÀY NỮ
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="position-relative group-cat">
                <img src="https://images.unsplash.com/photo-1512374382149-233c42b6a83b?q=80&w=800&auto=format&fit=crop" 
                     class="w-100" style="height: 400px; object-fit: cover;" alt="Phụ kiện">
                <a href="{{ route('shop.category', 'phu-kien') }}" class="btn btn-light rounded-0 position-absolute bottom-0 start-50 translate-middle-x mb-4 fw-bold px-4">
                    PHỤ KIỆN
                </a>
            </div>
        </div>
    </div>

</div>
@endsection