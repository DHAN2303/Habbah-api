<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'ref_no',
        'price',
        'quantity'
    ];

    public function orderStatus(){
        return $this->belongsTo(OrderStatus::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }


}
