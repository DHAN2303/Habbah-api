<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MarketingBox;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class MarketingBoxController extends Controller
{

    public function getMarketingBoxById($id)
    {
        $getMarketingBoxById = MarketingBox::find($id);
        return [$getMarketingBoxById];
    }

    public function createMarketingBox(Request $request)
    {

        $validatedData = $request->validate([
            'image_url' => 'required',
            'text' => 'required',
            'redirect_url' => 'required',
            'is_active' => 'required|max:255',
            'type' => 'required|max:255',
        ]);

        if(MarketingBox::create($validatedData))
        {
            return response()->json(['massage:'=>'Marketing box has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }



    }

    public function updateMarketingBox(MarketingBox $marketingBox, Request $request)
    {

        $validatedData = $request->validate([
            'image_url' => 'required',
            'text' => 'required',
            'redirect_url' => 'required',
             'is_active' => 'required|max:255',
             'type' => 'required|max:255',
        ]);



        if($marketingBox->update($validatedData)){
            return response()->json(['massage:'=>'Marketing box has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }


    }

    public function deleteMarketingBox(MarketingBox $marketingBox)
    {

        if($marketingBox->delete()){
            return response()->json(['massage:'=>'Marketing box has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }
}
