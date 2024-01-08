<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategoryById($id)
    {
        $category = Category::find($id);
        $category->load('SubCategory');
        return ['Category'=>$category];
    }

    public function createCategory(Request $request)
    {
        $validatedData = $request->validate([

            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'image' => 'required|max:255',
            'slug' => 'required|max:255',
            'is_active'=> 'required|max:255'

        ]);

        if(Category::create($validatedData)){
            return response()->json(['massage:'=>'Category has been created successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }

    }

    public function updateCategory(Category $category,Request $request)
    {
        $validatedData = $request->validate([
            'name_ar' => 'required|max:255',
            'name_en' => 'required|max:255',
            'image' => 'required|max:255',
            'is_active'=> 'required|max:255'
        ]);

        if($category->update($validatedData)){
            return response()->json(['massage:'=>'Category has been updated successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }
    }

    public function deleteCategory(Category $category)
    {
        if($category->delete()){
            return response()->json(['massage:'=>'Category has been deleted successfully'],200);
        }
        else{
            return response()->json(['message' => 'ERROR PLEASE TRY AGAIN LATER'], 500);
        }
    }
}
