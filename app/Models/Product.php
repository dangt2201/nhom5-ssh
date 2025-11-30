<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price',
        'price_sale',
        'description',
        'is_active'
    ];

    // N-1: Thuộc về 1 danh mục
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // N-1: Thuộc về 1 thương hiệu
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // 1-N: Có nhiều biến thể (Size/Màu)
    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}