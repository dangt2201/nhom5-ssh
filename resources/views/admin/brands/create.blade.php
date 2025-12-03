@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Thêm Thương hiệu</h6></div>
    <div class="card-body">
        <form action="{{ route('brands.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Tên Thương hiệu</label>
                <input type="text" name="name" class="form-control" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="form-group">
                <label>Logo</label>
                <input type="file" name="logo" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="active" checked>
                <label class="form-check-label" for="active">Hiển thị</label>
            </div>
            <button type="submit" class="btn btn-success">Lưu lại</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection