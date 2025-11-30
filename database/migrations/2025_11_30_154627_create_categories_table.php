<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('categories', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên danh mục [cite: 5]
        $table->string('slug')->unique(); // Slug để làm URL đẹp (VD: giay-the-thao) - Nên thêm
        $table->text('description')->nullable(); // Mô tả [cite: 5]
        $table->integer('sort_order')->default(0); // Thứ tự hiển thị [cite: 5]
        $table->boolean('is_active')->default(true);// Hiển thị/Ẩn [cite: 5]
        $table->timestamps(); // Bao gồm cả ngay_tao và ngay_cap_nhat
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
