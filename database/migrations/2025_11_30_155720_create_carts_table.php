<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // File: create_carts_table.php
public function up(): void
{
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        // Mỗi user chỉ có 1 giỏ hàng (quan hệ 1-1 nếu muốn, hoặc 1-n)
        $table->foreignId('user_id')->nullable()->constrained('users'); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
