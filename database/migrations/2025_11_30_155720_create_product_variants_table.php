<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // File: create_product_variants_table.php
public function up(): void
{
    Schema::create('product_variants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Xóa cha thì xóa con
        $table->string('size', 50)->nullable();  // Kích thước (39, 40, XL...)
        $table->string('color', 50)->nullable(); // Màu sắc (Red, Blue...)
        $table->string('image')->nullable();     // Ảnh riêng cho biến thể (nếu có)
        $table->unsignedInteger('quantity')->default(0); // Số lượng tồn kho
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
