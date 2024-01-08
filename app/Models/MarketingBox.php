<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketingBox extends Model
{
    use HasFactory;
    protected $fillable = [
        'image_url',
        'text',
        'redirect_url',
        'is_active',
        'type',
    ];
}
