<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
