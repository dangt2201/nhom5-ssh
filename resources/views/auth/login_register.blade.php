@extends('layouts.app') @section('body')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="row bg-white p-4 shadow-sm rounded position-relative">
                
                <div class="col-md-6 pe-md-5 border-end-md">
                    <h3 class="text-center mb-4 text-uppercase fw-bold">Đăng nhập</h3>
                    
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Email đăng nhập<span class="text-danger">*</span></label>
                            <input type="text" name="mail" class="form-control rounded-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control rounded-0" required>
                        </div>
                        
                        <div class="d-flex align-items-center mb-3">
                            <button type="submit" class="btn btn-dark rounded-0 px-4 py-2 text-uppercase">Đăng nhập</button>
                            <a href="#" class="ms-auto text-decoration-none text-muted small">Quên mật khẩu?</a>
                        </div>
                    </form>

                    <div class="d-flex align-items-center my-4">
                        <hr class="flex-grow-1">
                        <span class="px-2 text-muted text-uppercase small">Hoặc</span>
                        <hr class="flex-grow-1">
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-primary w-100 rounded-0">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                        </div>
                        <div class="col-6">
                            <a href="#" class="btn btn-outline-danger w-100 rounded-0">
                                <i class="bi bi-google"></i> Google
                            </a>
                        </div>
                    </div>

                    <div class="mt-4 small text-muted">
                        Nếu Quý khách có vấn đề gì thắc mắc hoặc cần hỗ trợ gì thêm có thể liên hệ:<br>
                        Hotline: 1900.633.349<br>
                        Hoặc Inbox Facebook
                    </div>
                </div>

                <div class="or-circle d-none d-md-flex">
                    Or
                </div>

                <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                    <h3 class="text-center mb-4 text-uppercase fw-bold">Đăng ký</h3>
                    
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tên đăng nhập <span class="text-danger">*</span></label>
                            <input type="text" name="register_username" class="form-control rounded-0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control rounded-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Số điện thoại <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control rounded-0" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control rounded-0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nhắc lại mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control rounded-0" required>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-dark rounded-0 px-4 py-2 text-uppercase">Đăng ký</button>
                        </div>

                        <p class="mt-3 small text-muted">
                            Thông tin cá nhân của bạn sẽ được dùng để điền vào hóa đơn, giúp bạn thanh toán nhanh chóng và dễ dàng.
                        </p>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<style>
    /* Đường kẻ dọc giữa 2 cột (chỉ hiện trên màn hình to) */
    @media (min-width: 768px) {
        .border-end-md {
            border-right: 1px solid #dee2e6;
        }
    }

    /* Nút tròn OR ở giữa */
    .or-circle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 40px;
        height: 40px;
        background: white;
        border: 1px solid #dee2e6;
        border-radius: 50%;
        justify-content: center;
        align-items: center;
        font-style: italic;
        color: #6c757d;
        font-size: 0.9rem;
        z-index: 10;
    }

    /* Style lại input cho giống mẫu */
    .form-control:focus {
        box-shadow: none;
        border-color: #000;
    }
</style>
@endsection