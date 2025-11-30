<nav class="navbar navbar-expand-lg bg-white py-3 shadow-sm">
    <div class="container-fluid px-4">
        
        <a class="navbar-brand me-4" href="/">
            SOLID <span class="brand-highlight">TECH</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 flex-wrap">
                <li class="nav-item">
                    <a class="nav-link text-danger fw-bold" href="{{ route('shop.hotSale') }}">
                        <i class="bi bi-fire"></i> HOT SALE
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('brands.index') }}">Hãng</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.category', 'giay-nam') }}">Giày Nam</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.category', 'giay-nu') }}">Giày Nữ</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('shop.category', 'phu-kien') }}">Phụ kiện</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('return.policy') }}">Chính sách đổi trả</a>
                </li>
            </ul>

            <div class="d-flex align-items-center mt-3 mt-lg-0">
                
                <form class="d-flex me-3" role="search">
                    <div class="input-group">
                        <input class="form-control search-input shadow-none" type="search" placeholder="Bạn tìm gì..." aria-label="Search">
                        <button class="btn btn-outline-secondary search-btn" type="submit">
                            <i class="bi bi-search text-dark"></i>
                        </button>
                    </div>
                </form>

                @guest
                    <a href="{{ route('login') }}" class="text-dark me-3" title="Đăng nhập">
                        <i class="bi bi-person fs-4"></i>
                    </a>
                @else
                    <div class="dropdown me-3">
                        <a href="#" class="text-dark text-decoration-none dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                            <span class="fw-bold me-1 text-truncate" style="max-width: 100px;">
                                {{ Auth::user()->name }}
                            </span>
                            <i class="bi bi-person-circle fs-4"></i>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->role == 1)
                                <li>
                                    <a class="dropdown-item text-danger fw-bold" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>Vào trang Admin
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            
                            <li><a class="dropdown-item" href="#">Hồ sơ của tôi</a></li>
                            <li><a class="dropdown-item" href="#">Đơn mua</a></li>
                            <li><hr class="dropdown-divider"></li>
                            
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Đăng xuất
                                </a>
                            </li>
                        </ul>
                    </div>
                @endguest

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

                <a href="#" class="text-dark position-relative" title="Giỏ hàng">
                    <i class="bi bi-cart3 fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart-badge">
                        2
                    </span>
                </a>

            </div> </div>
    </div>
</nav>