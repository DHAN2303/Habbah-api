<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_en',
        'status_ar',
        'customer_status_en',
        'customer_status_ar',
        'code',
        'is_active'
    ];
   protected $primaryKey = 'code';

    public function orderproduct(){
        return $this->hasMany(OrderProduct::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }


}
