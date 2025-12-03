@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3"><h6 class="m-0 font-weight-bold text-primary">Sửa Thương hiệu</h6></div>
    <div class="card-body">
        <form action="{{ route('brands.update', $brand->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="form-group">
                <label>Tên Thương hiệu</label>
                <input type="text" name="name" class="form-control" value="{{ $brand->name }}" required>
            </div>
            <div class="form-group">
                <label>Logo hiện tại</label><br>
                @if($brand->logo)
                    <img src="{{ asset($brand->logo) }}" width="100" class="mb-2 border">
                @endif
                <input type="file" name="logo" class="form-control-file">
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="3">{{ $brand->description }}</textarea>
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="active" {{ $brand->is_active ? 'checked' : '' }}>
                <label class="form-check-label" for="active">Hiển thị</label>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('brands.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection