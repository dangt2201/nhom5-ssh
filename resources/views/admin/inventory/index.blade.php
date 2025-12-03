@extends('admin.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Quản lý Kho Hàng Tổng Hợp</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('categories.index') }}" class="text-decoration-none">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Thành phần</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Danh Mục (Category)</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-folder fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('brands.index') }}" class="text-decoration-none"> <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đối tác</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Thương Hiệu (Brand)</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-tags fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Hàng hóa</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Sản Phẩm (Product)</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-box fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <a href="{{ route('product_variants.index') }}" class="text-decoration-none">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Chi tiết</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Biến Thể (Variant)</div>
                            </div>
                            <div class="col-auto"><i class="fas fa-cubes fa-2x text-gray-300"></i></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection