<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemporaryHold extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_variant_id',
        'session_id',
        'quantity',
        'started_at',
        'expired_at'
    ];

    // Quan hệ N-1: Thuộc về 1 biến thể sản phẩm (để biết đang giữ cái giày nào)
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}