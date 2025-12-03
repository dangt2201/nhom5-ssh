@extends('admin.admin')

@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa sản phẩm: {{ $product->name }}</h1>
        <a href="{{ route('products.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Quay lại
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- PHẦN 1: THÔNG TIN CHUNG SẢN PHẨM -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Thông tin chính</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tên sản phẩm <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mã SKU</label>
                            <input type="text" name="sku" class="form-control" value="{{ old('sku', $product->sku) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Danh mục <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-control" required>
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Thương hiệu <span class="text-danger">*</span></label>
                            <select name="brand_id" class="form-control" required>
                                <option value="">-- Chọn thương hiệu --</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá bán (VNĐ) <span class="text-danger">*</span></label>
                            <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Giá khuyến mãi (VNĐ)</label>
                            <input type="number" name="price_sale" class="form-control" value="{{ old('price_sale', $product->price_sale) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <input type="file" name="img_thumbnail" class="form-control-file mb-2" onchange="previewImage(this)">
                    
                    <div class="d-flex align-items-center mt-2">
                        @if($product->img_thumbnail)
                            <div class="mr-3 text-center">
                                <p class="small mb-1">Ảnh hiện tại:</p>
                                <img src="{{ asset($product->img_thumbnail) }}" width="100" class="img-thumbnail">
                            </div>
                        @endif
                        
                        <div id="image-preview-container" style="display: none;" class="text-center">
                            <p class="small mb-1">Ảnh mới chọn:</p>
                            <img id="image-preview" src="#" alt="Preview" width="100" class="img-thumbnail">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" name="is_active" id="active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">Hiển thị sản phẩm này</label>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật thông tin chính</button>
            </form>
        </div>
    </div>

    <!-- PHẦN 2: QUẢN LÝ BIẾN THỂ (SIZE / MÀU) -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-success">Quản lý Biến thể (Size & Màu)</h6>
        </div>
        <div class="card-body">
            
            <!-- Form thêm biến thể -->
            <form action="{{ route('product_variants.store', $product->id) }}" method="POST" class="mb-4 p-3 bg-light border rounded">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label class="small font-weight-bold">Size <span class="text-danger">*</span></label>
                            <input type="text" name="size" class="form-control" placeholder="VD: 39, 40, XL..." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label class="small font-weight-bold">Màu sắc <span class="text-danger">*</span></label>
                            <input type="text" name="color" class="form-control" placeholder="VD: Trắng, Đen..." required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group mb-0">
                            <label class="small font-weight-bold">Số lượng tồn <span class="text-danger">*</span></label>
                            <input type="number" name="quantity" class="form-control" value="0" min="0" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-success btn-block" style="margin-top: 30px;">
                            <i class="fas fa-plus"></i> Thêm ngay
                        </button>
                    </div>
                </div>
            </form>

            <hr>

            <!-- Bảng danh sách biến thể -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>Size</th>
                            <th>Màu sắc</th>
                            <th>Số lượng tồn</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($product->variants as $variant)
                            <tr>
                                <td class="align-middle font-weight-bold">{{ $variant->size }}</td>
                                <td class="align-middle">{{ $variant->color }}</td>
                                <td class="align-middle">
                                    @if($variant->quantity > 0)
                                        <span class="badge badge-success px-2 py-1">{{ $variant->quantity }}</span>
                                    @else
                                        <span class="badge badge-danger px-2 py-1">Hết hàng</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <form action="{{ route('product_variants.destroy', $variant->id) }}" method="POST" class="d-inline form-confirm" data-confirm-text="Xóa biến thể này?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                            <i class="fas fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Chưa có biến thể nào. Hãy thêm ở trên!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('#image-preview').attr('src', e.target.result);
                $('#image-preview-container').show();
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            $('#image-preview-container').hide();
        }
    }
</script>
@endsection
