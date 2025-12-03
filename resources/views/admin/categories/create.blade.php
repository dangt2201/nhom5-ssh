@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Thêm Danh mục Mới</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Tên Danh mục <span class="text-danger">*</span></label>
                <input type="text" name="name" class="form-control" required placeholder="Nhập tên danh mục...">
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_active" id="activeCheck" checked>
                <label class="form-check-label" for="activeCheck">Hiển thị ngay</label>
            </div>

            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Lưu lại</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</div>
@endsection