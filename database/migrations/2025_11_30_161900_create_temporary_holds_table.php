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
    Schema::create('temporary_holds', function (Blueprint $table) {
        $table->id();
        $table->foreignId('product_variant_id')->constrained('product_variants')->onDelete('cascade');
        $table->string('session_id'); // ID phiên làm việc của khách
        $table->integer('quantity');  // Số lượng giữ
        $table->dateTime('started_at'); // Bắt đầu giữ
        $table->dateTime('expired_at'); // Hết hạn (thường là +15 phút)
        $table->timestamps();
        
        // Index để tìm kiếm nhanh khi check hết hạn
        $table->index(['product_variant_id', 'session_id', 'expired_at']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temporary_holds');
    }
};
