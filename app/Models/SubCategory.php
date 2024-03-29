<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar','name_en','slug','image', 'category_id', 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function product()
    {
        return $this -> belongsToMany(Product::class);
    }
}
