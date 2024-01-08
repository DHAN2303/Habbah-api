<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\OAuthV1 as OAuthV1;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{
    public function getOrderById($id)
    {
        $getOrderById = Order::find($id);
        $getOrderById['order_status'] = OrderStatus::find($getOrderById['order_status_id']);
        return [$getOrderById];
    }

    public function getOrderByUserId($id)
    {
        if($id == auth()->id()){
            $getOrderByUserId = Order::where('user_id', $id)->get();
            return [$getOrderByUserId];}
        else
            return response()->json(['message' => 'you don\'t own this cart'], 401);


    }

    public function createOrder(Request $request)
    {
        $validatedData = $request->validate([
            'ref_no' => 'required',
            'order_status_id' => 'required',
            'total' => 'required',
        ]);
        $validatedData['user_id'] = auth()->id();

        if(Order::create($validatedData)){
            return response()->json(['massage:'=>'Order has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function updateOrder(Order $order, Request $request)
    {

        $validatedData = $request->validate([
            'order_status_id' => 'required',
            'total' => 'required',
        ]);


        if($order->update($validatedData)){
            return response()->json(['massage:'=>'Order has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function deleteOrder(order $order)
    {
        if($order->delete()){
            return response()->json(['massage:'=>'Order has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }
}
