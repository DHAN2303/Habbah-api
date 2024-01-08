<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function getProductImageById($id)
    {
        $productImage = ProductImage::find($id);
        return [$productImage];
    }
    public function getAllProductImagesById($id)
    {
        $productImage = ProductImage::where('product_id',$id)->get();
        return [$productImage];
    }

    public function uploadImages(Request $request)
    {
        $validatedData = $request->validate([
            'image_url' => 'required',
            'product_id' => 'required|max:255',
        ]);

        if(ProductImage::create($validatedData)){
            return response()->json(['massage:'=>'Product images has been uploaded successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function updateimages(ProductImage $productImage, Request $request)
    {
        $validatedData = $request->validate([

            'image_url' => 'required',
            'product_id' => 'required|max:255',]);


        if($productImage->update($validatedData)){
            return response()->json(['massage:'=>'Product images has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }



    public function deleteImages(ProductImage $productImage)
    {
        if($productImage->delete()){
            return response()->json(['massage:'=>'Product images has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }
}
