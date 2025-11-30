<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusHistory extends Model
{
    use HasFactory;

    // Tắt timestamps mặc định vì bảng này chỉ cần ghi nhận thời điểm tạo (changed_at)
    public $timestamps = false; 

    protected $fillable = [
        'order_id',
        'previous_status',
        'new_status',
        'user_id',
        'note',
        'changed_at'
    ];

    // Thuộc về đơn hàng nào
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Ai là người thay đổi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}