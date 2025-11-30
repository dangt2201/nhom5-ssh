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
    Schema::create('order_status_histories', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
        $table->string('previous_status')->nullable(); // Trạng thái cũ (có thể null nếu mới tạo)
        $table->string('new_status'); // Trạng thái mới
        $table->foreignId('user_id')->nullable()->constrained('users'); // Người thực hiện thay đổi
        $table->text('note')->nullable(); // Ghi chú (VD: Khách gọi điện hủy đơn)
        $table->timestamp('changed_at')->useCurrent(); // Thời điểm thay đổi
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_histories');
    }
};
