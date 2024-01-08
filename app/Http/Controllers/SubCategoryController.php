<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{

    public function getSubCategoryById($id)
{
    $subcategory = SubCategory::find($id);
    $subcategory->load('Category');
    return ['SubCategory'=>$subcategory];
}

    public function createSubCategory(Request $request)
    {
        $validatedData = $request->validate([

            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'image' => 'required|max:255',
            'slug' => 'required|max:255',
            'category_id'=> 'required|max:255',
            'is_active'=> 'required|max:255'
        ]);

        if(SubCategory::create($validatedData)){
            return response()->json(['massage:'=>'SubCategory has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function updateSubCategory(SubCategory $subCategory, Request $request)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'image' => 'required|max:255',
            'category_id' => 'required|max:255',
            'is_active' => 'required|max:255'
        ]);

        if($subCategory->update($validatedData)){
            return response()->json(['massage:'=>'SubCategory has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }
    }

    public function deleteSubCategory(SubCategory $subCategory)
    {
        if($subCategory->delete()){
            return response()->json(['massage:'=>'SubCategory has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }
    }
}
