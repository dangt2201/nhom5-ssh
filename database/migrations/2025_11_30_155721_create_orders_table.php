<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // File: create_orders_table.php
public function up(): void
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained('users'); // Người mua
        
        // Thông tin người nhận (Có thể khác người mua)
        $table->string('user_name');
        $table->string('user_email');
        $table->string('user_phone');
        $table->string('user_address');
        $table->text('user_note')->nullable();

        $table->boolean('is_ship_user_same_user')->default(true); // Người nhận có phải người mua không

        // Trạng thái đơn hàng (Dùng Enum hoặc String) [cite: 74]
        // pending: Chờ xử lý, shipping: Đang giao, completed: Hoàn thành, cancelled: Hủy
        $table->string('status_order')->default('pending'); 
        $table->string('status_payment')->default('unpaid'); // Trạng thái thanh toán

        $table->decimal('total_price', 15, 2); // Tổng tiền
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
