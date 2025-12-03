@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý Thương hiệu</h6>
        <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Thêm mới</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Logo</th>
                    <th>Tên</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($brands as $brand)
                <tr>
                    <td>{{ $brand->id }}</td>
                    <td>
                        @if($brand->logo)
                            <img src="{{ asset($brand->logo) }}" width="50">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </td>
                    <td>{{ $brand->name }}</td>
                    <td>{!! $brand->is_active ? '<span class="badge badge-success">Hiện</span>' : '<span class="badge badge-secondary">Ẩn</span>' !!}</td>
                    <td>
                        <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $brands->links() }}
    </div>
</div>
@endsection

@section('scripts')
<script>
    // SweetAlert cho nút xóa
    $(document).on('click', '.btn-delete', function(e) {
        let form = $(this).closest('form');
        Swal.fire({
            title: 'Xóa danh mục này?',
            text: "Sản phẩm thuộc danh mục này cũng có thể bị ảnh hưởng!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            confirmButtonText: 'Xóa ngay',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });

    @if(session('success'))
        Swal.fire('Thành công!', "{{ session('success') }}", 'success');
    @endif
</script>
@endsection