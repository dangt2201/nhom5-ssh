<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantController extends Controller
{
    // Hiển thị danh sách toàn bộ biến thể (Kho hàng)
    public function index()
    {
        // Lấy tất cả biến thể, kèm thông tin sản phẩm cha
        $variants = ProductVariant::with('product')->latest()->paginate(15);
        return view('admin.variants.index', compact('variants'));
    }
    // Lưu biến thể mới (Sẽ được gọi từ form trong trang Edit sản phẩm)
    public function store(Request $request, $productId)
    {
        $request->validate([
            'size' => 'required',
            'color' => 'required',
            'quantity' => 'required|numeric|min:0',
        ]);

        // Kiểm tra xem biến thể này (Size + Color) đã tồn tại cho sản phẩm này chưa
        $exists = ProductVariant::where('product_id', $productId)
            ->where('size', $request->size)
            ->where('color', $request->color)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Biến thể này (Size ' . $request->size . ' - Màu ' . $request->color . ') đã tồn tại!');
        }

        ProductVariant::create([
            'product_id' => $productId,
            'size' => $request->size,
            'color' => $request->color,
            'quantity' => $request->quantity,
        ]);

        return back()->with('success', 'Thêm biến thể thành công!');
    }

    // Xóa biến thể
    public function destroy($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->delete();

        return back()->with('success', 'Đã xóa biến thể!');
    }
}