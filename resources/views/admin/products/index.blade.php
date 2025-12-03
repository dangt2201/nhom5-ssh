@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý Sản phẩm</h6>
        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Thêm mới</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên SP</th>
                        <th>Danh mục</th>
                        <th>Hãng</th>
                        <th>Giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $p)
                    <tr>
                        <td>
                            @if(Str::startsWith($p->img_thumbnail, 'http'))
                                <img src="{{ $p->img_thumbnail }}" width="50">
                            @else
                                <img src="{{ asset($p->img_thumbnail) }}" width="50">
                            @endif
                        </td>
                        <td>{{ $p->name }}</td>
                        <td>{{ $p->category->name ?? 'N/A' }}</td>
                        <td>{{ $p->brand->name ?? 'N/A' }}</td>
                        <td>{{ number_format($p->price) }}đ</td>
                        <td>
                            <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('products.destroy', $p->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
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