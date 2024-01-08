<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderStatusController extends Controller
{
    public function getOrderStatusById()
    {
        $getOrderStatusById = OrderStatus::all();
        return [$getOrderStatusById];
    }
    public function createOrderStatus(Request $request)
    {

        $validatedData = $request->validate([
            'status_en' => 'required',
            'code' => 'required',
            'status_ar' => 'nullable',
            'customer_status_en' => 'required',
            'customer_status_ar' => 'nullable',
            'is_active' => 'required'
        ]);

        if(OrderStatus::create($validatedData)){
            return response()->json(['massage:'=>'Order status has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }


    }

    public function updateOrderStatus(OrderStatus $orderStatus, Request $request)
    {

        $validatedData = $request->validate([
            'status_en' => 'required',
            'status_ar' => 'required',
            'customer_status_en' => 'required',
            'customer_status_ar' => 'required',
            'is_active' => 'required',
        ]);

        if($orderStatus->update($validatedData)){

            return response()->json(['massage:'=>'Order status has been updated successfully'],200);}

        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);}

    }



    public function deleteOrderStatus(OrderStatus $orderStatus)
    {

        if($orderStatus->delete()){
            return response()->json(['massage:'=>'Order status has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }
}
