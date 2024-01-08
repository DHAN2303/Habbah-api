<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderProductController extends Controller
{
    public function getOrderProductById($id)
{
    $getOrderProductById = OrderProduct::find($id);
    $getOrderProductById->with('Order');
    return [$getOrderProductById];
}



    public function createOrderProduct(Request $request)
    {

        $validatedData = $request->validate([
            'ref_no' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        if(OrderProduct::create($validatedData)){
            return response()->json(['massage:'=>'Order product has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }


    }

    public function updateOrderProduct(OrderProduct $orderProduct, Request $request)
    {

        $validatedData = $request->validate([
            'price' => 'required',
            'quantity' => 'required',
        ]);


        if($orderProduct->update($validatedData)){
            return response()->json(['massage:'=>'Order product has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function deleteOrderProduct(OrderProduct $orderProduct)
    {

        if($orderProduct->delete()){
            return response()->json(['massage:'=>'Order product has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }
}
