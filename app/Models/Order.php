<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'ref_no',
        'user_id',
        'order_status_id',
        'total'
    ];
    protected $primaryKey = 'ref_no';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function product(){
        return $this->hasMany(Product::class);
    }

    public function orderstatus(){
        return $this->BelongsTo(OrderStatus::class);
    }

    public function orderproduct(){
        return $this->hasMany(OrderProduct::class);
    }


}
