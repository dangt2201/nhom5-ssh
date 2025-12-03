<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // 1. Danh sách sản phẩm (Admin view)
    public function index()
    {
        $products = Product::with(['category', 'brand'])->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    // 2. Form thêm mới
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    // 3. Xử lý thêm mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'brand_id' => 'required',
            'img_thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name); // Tạo slug tự động
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Upload ảnh
        if ($request->hasFile('img_thumbnail')) {
            $file = $request->file('img_thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['img_thumbnail'] = 'uploads/products/' . $filename;
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    // 4. Form sửa
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    // 5. Xử lý cập nhật
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name);
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        // Upload ảnh mới (nếu có)
        if ($request->hasFile('img_thumbnail')) {
            // Xóa ảnh cũ
            if ($product->img_thumbnail && File::exists(public_path($product->img_thumbnail))) {
                File::delete(public_path($product->img_thumbnail));
            }

            $file = $request->file('img_thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $data['img_thumbnail'] = 'uploads/products/' . $filename;
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Cập nhật thành công!');
    }

    // 6. Xóa sản phẩm
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->img_thumbnail && File::exists(public_path($product->img_thumbnail))) {
            File::delete(public_path($product->img_thumbnail));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}