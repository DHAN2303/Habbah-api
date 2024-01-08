<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku',
        'ref_sku',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'quantity',
        'price',
        'slug',
        'is_discount_applied',
        'is_active',
    ];

    public function wishlist(){
        return $this->hasMany(WishList::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function productimage(){
        return $this->hasMany(ProductImage::class);
  }

    public function order(){
        return $this->belongsTo(Order::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }
}
