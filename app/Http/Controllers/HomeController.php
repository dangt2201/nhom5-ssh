<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Lấy tất cả danh mục đang active
        // with('products'): Eager loading để lấy luôn 4 sản phẩm mới nhất của danh mục đó
        $categories = Category::where('is_active', true)
            ->with(['products' => function($query) {
                $query->where('is_active', true)->latest()->take(4);
            }])
            ->get();

        // 2. Lấy sản phẩm HOT SALE (có giá khuyến mãi)
        $hotProducts = Product::where('is_active', true)
            ->whereNotNull('price_sale')
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('categories', 'hotProducts'));
    }
}