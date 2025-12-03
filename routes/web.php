<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\Admin\BrandController as AdminBrandController;
use App\Http\Controllers\Admin\InventoryController;
use App\Http\Controllers\Admin\CategoryController;

Route::get('/', function () {
    return view('home');
});
Route::middleware(['auth', CheckAdmin::class])->prefix('admin')->group(function () {

    // Đường dẫn sẽ là: domain.com/admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    // Đường dẫn quản lý sản phẩm: domain.com/admin/products/...
    Route::resource('products', ProductController::class);
    // Trang quản lý chung
    Route::get('/inventory', [InventoryController::class, 'index'])->name('admin.inventory');

    // CRUD CHO CATEGORYS (DANH MỤC)
    Route::resource('categories', CategoryController::class);
    // CRUD CHO BRANDS 
    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);

    // Route quản lý Brand
    Route::resource('brands', AdminBrandController::class);

});
Route::get('/login', [LoginController::class, 'showLoginRegister'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [LoginController::class, 'register'])->name('register');
Route::get('/return-policy', function () {
    return view('user.return_policy');
})->name('return.policy');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/danh-muc/{slug}', [ProductController::class, 'getByCategory'])->name('shop.category');
Route::get('/san-pham', [ProductController::class, 'index'])->name('shop.index');
Route::get('/san-pham/{slug}.html', [ProductController::class, 'detail'])->name('shop.detail');
// Route danh sách Hãng
Route::get('/thuong-hieu', [BrandController::class, 'index'])->name('brands.index');
Route::get('/thuong-hieu/{slug}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/hot-sale', [ProductController::class, 'hotSale'])->name('shop.hotSale');


