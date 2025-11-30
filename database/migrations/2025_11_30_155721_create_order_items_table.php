<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // File: create_order_items_table.php
public function up(): void
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
        $table->foreignId('product_variant_id')->constrained('product_variants');
        
        // Snapshot dữ liệu (Lưu lại thông tin lúc mua)
        $table->string('product_name'); 
        $table->string('product_sku');
        $table->string('product_img_thumbnail')->nullable();
        $table->decimal('product_price', 15, 2); // Giá lúc mua
        $table->string('variant_size_name')->nullable();
        $table->string('variant_color_name')->nullable();
        
        $table->unsignedInteger('quantity'); // Số lượng mua
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
