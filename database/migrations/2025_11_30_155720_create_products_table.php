<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // File: create_products_table.php
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('category_id')->constrained('categories'); // Liên kết bảng Category
        $table->foreignId('brand_id')->constrained('brands');       // Liên kết bảng Brand
        $table->string('name');             // Tên sản phẩm
        $table->string('slug')->unique()->nullable(); // Đường dẫn SEO
        $table->string('sku')->nullable();  // Mã sản phẩm chung (nếu cần)
        $table->string('img_thumbnail')->nullable(); // Ảnh đại diện
        $table->decimal('price', 15, 2);    // Giá bán thường
        $table->decimal('price_sale', 15, 2)->nullable(); // Giá khuyến mãi
        $table->text('description')->nullable(); // Mô tả chi tiết
        $table->boolean('is_active')->default(true); // Trạng thái hiển thị
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
