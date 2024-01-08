<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name_ar', 'name_en', 'image', 'slug', 'is_active'];


    public function subcategory()
    {
        return $this->hasMany(SubCategory::class);
    }
    public function products()
    {
        return $this -> belongsToMany(Product::class);
    }
}
