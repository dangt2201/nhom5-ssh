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
    // 1. Trang danh sách tất cả sản phẩm
    public function index()
    {
        $products = Product::where('is_active', true)->paginate(9);
        $categoryName = "Tất cả sản phẩm";
        return view('products.index', compact('products', 'categoryName'));
    }

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

    // 3. Trang chi tiết sản phẩm
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

    // 4. Trang Hot Sale
    public function hotSale()
    {
        $products = Product::where('is_active', true)
                           ->whereNotNull('price_sale')
                           ->whereColumn('price_sale', '<', 'price')
                           ->latest()
                           ->paginate(9);

        return view('products.index', [
            'products' => $products,
            'categoryName' => 'Săn Sale Giá Sốc 🔥'
        ]);
    }
}
