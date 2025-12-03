@extends('admin.admin')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Quản lý Tồn Kho (Biến thể)</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="bg-light">
                    <tr>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh</th>
                        <th>Size</th>
                        <th>Màu</th>
                        <th>Tồn kho</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($variants as $variant)
                    <tr>
                        <td>
                            <!-- Bấm vào tên để sang trang sửa sản phẩm gốc -->
                            <a href="{{ route('products.edit', $variant->product_id) }}" class="font-weight-bold">
                                {{ $variant->product->name ?? 'Sản phẩm đã xóa' }}
                            </a>
                            <br>
                            <small class="text-muted">SKU: {{ $variant->product->sku ?? 'N/A' }}</small>
                        </td>
                        <td>
                            <img src="{{ asset($variant->product->img_thumbnail ?? '') }}" width="40" style="border-radius: 4px;">
                        </td>
                        <td><span class="badge badge-info">{{ $variant->size }}</span></td>
                        <td>{{ $variant->color }}</td>
                        <td>
                            @if($variant->quantity == 0)
                                <span class="badge badge-danger">Hết hàng</span>
                            @elseif($variant->quantity < 10)
                                <span class="badge badge-warning text-dark">Sắp hết ({{ $variant->quantity }})</span>
                            @else
                                <span class="badge badge-success">{{ $variant->quantity }}</span>
                            @endif
                        </td>
                        <td>
                            <!-- Nút xóa nhanh biến thể lẻ -->
                            <form action="{{ route('product_variants.destroy', $variant->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm btn-delete" title="Xóa size này">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3">
                {{ $variants->links() }}
            </div>
        </div>
    </div>
</div>
@endsection