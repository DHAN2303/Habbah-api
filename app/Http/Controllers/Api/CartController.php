<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;


class CartController extends Controller
{
    public function getCartById($id)
    {
        $cart = cart::find($id);
        return [$cart];
    }

    public function getCartByUserId($id)
    {       if($id == auth()->id()){
        $cart = Cart::where('user_id', $id)->get();
        return [$cart];}
        else
            return response()->json(['message' => 'you don\'t own this cart'], 401);
    }

    public function createCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
            'quantity' => 'required',
        ]);
        $validatedData['user_id'] = auth()->id();

           $quantityProduct = Product::find($validatedData['product_id']);

        if($validatedData['quantity']>$quantityProduct['quantity']){
            return  response()->json(['message' => 'quantity is not enough'], 404);
        }
        if(Cart::create($validatedData)){
        return response()->json(['massage:'=>'cart has been added to cart successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }


    }

    public function updateCart(Cart $cart,Request $request)
    {

        $validatedData = $request->validate([

            'quantity' => 'required',
        ]);

        if($cart['user_id'] == auth()->id()){
            $cart->update($validatedData);
        return response()->json(['massage:'=>'product`s quantity has been changed successfully'],200);
    }
    else{
        return response()->json(['message' => 'you don\'t own this cart'], 401);
    }


    }

    public function deleteCart(Cart $cart)
    {

        if($cart->delete()){
            return response()->json(['massage:'=>'Product has been removed from cart successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }


    }



}
