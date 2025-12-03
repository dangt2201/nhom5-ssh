@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Thêm Sản phẩm</h6></div>
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Tên Sản phẩm</label>
                    <input type="text" name="name" class="form-control" required>
                    @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="col-md-6 form-group">
                    <label>Mã SKU</label>
                    <input type="text" name="sku" class="form-control">
                    @error('sku') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Danh mục</label>
                    <select name="category_id" class="form-control" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 form-group">
                    <label>Thương hiệu</label>
                    <select name="brand_id" class="form-control" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 form-group">
                    <label>Giá bán</label>
                    <input type="number" name="price" class="form-control" required>
                </div>
                <div class="col-md-6 form-group">
                    <label>Giá khuyến mãi</label>
                    <input type="number" name="price_sale" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label>Ảnh đại diện</label>
                <input type="file" name="img_thumbnail" class="form-control-file" required>
            </div>

            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="active" checked>
                <label class="form-check-label" for="active">Hiển thị ngay</label>
            </div>

            <button type="submit" class="btn btn-success">Lưu lại</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection