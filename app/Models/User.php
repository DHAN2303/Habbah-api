<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class  User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens,SoftDeletes;

    public function wishlist(){
        return $this->hasMany(WishList::class);
    }
    public function cart(){
        return $this->hasOne(Cart::class);
    }

    public function order(){
        return $this->hasMany(order::class);
    }
    public function product(){
        return $this->hasMany(Product::class);
    }



    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
