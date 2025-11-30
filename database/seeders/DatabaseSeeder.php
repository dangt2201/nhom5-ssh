<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Mật khẩu là 123456
            'role' => 1, // 1 là Admin
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '082636774',
            'password' => Hash::make('123456'),
            'role' => 0,
        ]);


       // ==========================================
        // 2. TẠO DANH MỤC (CHỈ 3 CÁI THEO MENU)
        // ==========================================
        $cat_nam = Category::create(['name' => 'Giày Nam', 'slug' => 'giay-nam', 'description' => 'Thời trang phái mạnh', 'is_active' => true]);
        $cat_nu = Category::create(['name' => 'Giày Nữ', 'slug' => 'giay-nu', 'description' => 'Duyên dáng & Cá tính', 'is_active' => true]);
        $cat_pk = Category::create(['name' => 'Phụ Kiện', 'slug' => 'phu-kien', 'description' => 'Vớ, Dây giày, Vệ sinh giày', 'is_active' => true]);

        // ==========================================
        // 3. TẠO THƯƠNG HIỆU
        // ==========================================
        $nike = Brand::create(['name' => 'Nike', 'slug' => 'nike', 'is_active' => true]);
        $adidas = Brand::create(['name' => 'Adidas', 'slug' => 'adidas', 'is_active' => true]);
        $puma = Brand::create(['name' => 'Puma', 'slug' => 'puma', 'is_active' => true]);
        $vans = Brand::create(['name' => 'Vans', 'slug' => 'vans', 'is_active' => true]);
        $crep = Brand::create(['name' => 'Crep Protect', 'slug' => 'crep', 'is_active' => true]); // Hãng phụ kiện nổi tiếng

        // ==========================================
        // 4. TẠO SẢN PHẨM (SẮP XẾP LẠI)
        // ==========================================

        // --- NHÓM 1: GIÀY NAM ---
        
        // 1. Nike Air Force 1
        $p1 = Product::create([
            'category_id' => $cat_nam->id, 'brand_id' => $nike->id,
            'name' => 'Nike Air Force 1 Low', 'slug' => 'nike-af1-white',
            'sku' => 'NIKE-AF1-001',
            'img_thumbnail' => 'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/b7d9211c-26e7-431a-ac24-b0540fb3c00f/air-force-1-07-shoe-WrLlWX.png',
            'price' => 3500000, 'price_sale' => 2900000,
            'description' => 'Huyền thoại đường phố, màu trắng tinh khôi.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p1->id, 'size' => '40', 'color' => 'Trắng', 'quantity' => 10]);
        ProductVariant::create(['product_id' => $p1->id, 'size' => '41', 'color' => 'Trắng', 'quantity' => 5]);

        // 2. Adidas Ultraboost (Chuyển vào Nam)
        $p2 = Product::create([
            'category_id' => $cat_nam->id, 'brand_id' => $adidas->id,
            'name' => 'Adidas Ultraboost 22', 'slug' => 'adidas-ub22-blk',
            'sku' => 'ADI-UB22-BLK',
            'img_thumbnail' => 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/fbaf991a78bc4896a3e9ad7800abcec6_9366/Ultraboost_22_Shoes_Black_GZ0127_01_standard.jpg',
            'price' => 4200000, 'price_sale' => null,
            'description' => 'Đế Boost êm ái, chạy bộ cực thích.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p2->id, 'size' => '41', 'color' => 'Đen', 'quantity' => 15]);
        ProductVariant::create(['product_id' => $p2->id, 'size' => '42', 'color' => 'Đen', 'quantity' => 8]);

        // 3. Vans Old Skool
        $p3 = Product::create([
            'category_id' => $cat_nam->id, 'brand_id' => $vans->id,
            'name' => 'Vans Old Skool Classic', 'slug' => 'vans-old-skool',
            'sku' => 'VANS-OS-BLK',
            'img_thumbnail' => 'https://images.vans.com/is/image/Vans/VN000D3HY28-HERO?$583x583$',
            'price' => 1650000, 'price_sale' => null,
            'description' => 'Đôi giày trượt ván biểu tượng.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p3->id, 'size' => '40', 'color' => 'Đen', 'quantity' => 50]);

        // --- NHÓM 2: GIÀY NỮ ---

        // 4. Puma Suede
        $p4 = Product::create([
            'category_id' => $cat_nu->id, 'brand_id' => $puma->id,
            'name' => 'Puma Suede Classic XXI', 'slug' => 'puma-suede-red',
            'sku' => 'PUMA-SD-RED',
            'img_thumbnail' => 'https://images.puma.com/image/upload/f_auto,q_auto,b_rgb:fafafa,w_2000,h_2000/global/374915/02/sv01/fnd/IND/fmt/png/Suede-Classic-XXI-Sneakers',
            'price' => 2300000, 'price_sale' => 1150000,
            'description' => 'Chất liệu da lộn mềm mại, màu đỏ quyến rũ.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p4->id, 'size' => '36', 'color' => 'Đỏ', 'quantity' => 5]);
        ProductVariant::create(['product_id' => $p4->id, 'size' => '37', 'color' => 'Đỏ', 'quantity' => 8]);

        // 5. Adidas Stan Smith (Nữ)
        $p5 = Product::create([
            'category_id' => $cat_nu->id, 'brand_id' => $adidas->id,
            'name' => 'Adidas Stan Smith Women', 'slug' => 'stan-smith-wht',
            'sku' => 'ADI-SS-WHT',
            'img_thumbnail' => 'https://assets.adidas.com/images/h_840,f_auto,q_auto,fl_lossy,c_fill,g_auto/b47d77dd6faa4e8a9f29a72101372df3_9366/Stan_Smith_Shoes_White_M20324_01_standard.jpg',
            'price' => 2500000, 'price_sale' => 2200000,
            'description' => 'Thiết kế tối giản, dễ thương.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p5->id, 'size' => '36', 'color' => 'Trắng/Xanh', 'quantity' => 20]);
        ProductVariant::create(['product_id' => $p5->id, 'size' => '37', 'color' => 'Trắng/Xanh', 'quantity' => 20]);

        // --- NHÓM 3: PHỤ KIỆN (MỚI) ---

        // 6. Chai vệ sinh giày Crep
        $p6 = Product::create([
            'category_id' => $cat_pk->id, 'brand_id' => $crep->id,
            'name' => 'Chai vệ sinh giày Crep Protect', 'slug' => 'crep-protect-cure',
            'sku' => 'CREP-CURE',
            'img_thumbnail' => 'https://product.hstatic.net/200000201143/product/crep-protect-spray-200ml_a9257007797e42998495955651231362_master.jpg',
            'price' => 450000, 'price_sale' => null,
            'description' => 'Dung dịch vệ sinh giày cao cấp, làm sạch mọi vết bẩn.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p6->id, 'size' => '200ml', 'color' => 'Mặc định', 'quantity' => 100]);

        // 7. Vớ Nike (Tất)
        $p7 = Product::create([
            'category_id' => $cat_pk->id, 'brand_id' => $nike->id,
            'name' => 'Vớ Nike Everyday Cushioned (3 Đôi)', 'slug' => 'vo-nike-3-pack',
            'sku' => 'NIKE-SOCK-3P',
            'img_thumbnail' => 'https://static.nike.com/a/images/t_PDP_1280_v1/f_auto,q_auto:eco/b1567342-9907-4226-9762-520240976378/everyday-cushioned-training-crew-socks-3-pairs-vlRw5q.png',
            'price' => 350000, 'price_sale' => 290000,
            'description' => 'Combo 3 đôi vớ cổ cao, dày dặn, thấm hút mồ hôi.',
            'is_active' => true,
        ]);
        ProductVariant::create(['product_id' => $p7->id, 'size' => 'Freesize', 'color' => 'Trắng', 'quantity' => 50]);
        ProductVariant::create(['product_id' => $p7->id, 'size' => 'Freesize', 'color' => 'Đen', 'quantity' => 50]);
    }
}
