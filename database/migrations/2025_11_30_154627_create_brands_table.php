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
    Schema::create('brands', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Tên thương hiệu [cite: 11]
        $table->string('slug')->unique(); // Nên thêm slug
        $table->text('description')->nullable(); // Mô tả [cite: 11]
        $table->string('logo')->nullable();// Đường dẫn logo [cite: 11]
        $table->boolean('is_active')->default(true);// Hiển thị/Ẩn [cite: 11]
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
