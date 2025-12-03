<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    // 2. Lọc sản phẩm theo danh mục
    public function getByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
                           ->where('is_active', true)
                           ->paginate(9);

        return view('products.index', [
            'products' => $products,
            'categoryName' => $category->name
        ]);
    }

    // 3.CHI TIẾT SẢN PHẨM 
    public function detail($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('is_active', true)
            ->with(['category', 'brand', 'variants']) 
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)
            ->get();

        return view('products.detail', compact('product', 'relatedProducts'));
    }
    public function hotSale()
    {
        $products = Product::where('is_active', true)
                           ->whereNotNull('price_sale') // Chỉ lấy cái nào có giá sale
                           ->whereColumn('price_sale', '<', 'price') // Đảm bảo giá sale nhỏ hơn giá gốc
                           ->latest() // Mới nhất lên đầu
                           ->paginate(9);
        return view('products.index', [
            'products' => $products,
            'categoryName' => 'Săn Sale Giá Sốc 🔥' // Tiêu đề trang
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('is_active', true)->paginate(9);
        $categoryName = "Tất cả sản phẩm";

        return view('products.index', compact('products', 'categoryName'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Bắt buộc có ảnh
        ]);

        $input = $request->all();

        // --- XỬ LÝ UPLOAD ẢNH (Giống khóa học) ---
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            // Đặt tên file: thời gian + tên gốc (để tránh trùng)
            $filename = time() . '_' . $file->getClientOriginalName();
            // Di chuyển vào thư mục public/uploads/products
            $file->move(public_path('uploads/products'), $filename);
            
            // Lưu đường dẫn vào database
            $input['img_thumbnail'] = 'uploads/products/' . $filename;
        }
        // -----------------------------------------

        Product::create($input);

        // Redirect kèm thông báo để SweetAlert hiện lên
        return redirect()->route('products.index')->with('success', 'Thêm sản phẩm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $input = $request->all();

        // Nếu người dùng chọn ảnh mới
        if ($request->hasFile('image')) {
            // 1. Xóa ảnh cũ đi cho đỡ rác server
            if (File::exists(public_path($product->img_thumbnail))) {
                File::delete(public_path($product->img_thumbnail));
            }

            // 2. Upload ảnh mới
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/products'), $filename);
            $input['img_thumbnail'] = 'uploads/products/' . $filename;
        }

        $product->update($input);

        return redirect()->route('products.index')->with('success', 'Cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh trong thư mục trước
        if (File::exists(public_path($product->img_thumbnail))) {
            File::delete(public_path($product->img_thumbnail));
        }

        // Xóa dữ liệu trong DB (Các biến thể sẽ tự mất do cấu hình Cascade)
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Đã xóa sản phẩm!');
    }
}
