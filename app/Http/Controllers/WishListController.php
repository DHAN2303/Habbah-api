<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function getWishList($id)

    {   $getWishList = WishList::where('user_id', $id)->get();
        return [$getWishList];
    }

    public function createWishList(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required',
        ]);
        $validatedData['user_id'] = auth()->id();
        $wishlist = WishList::where([['product_id', $validatedData['product_id']], ['user_id', $validatedData['user_id']]]) ->get()->first();
        if($wishlist != null)
            $wishlist->delete();

        else
            WishList::create($validatedData);

            return response()->json(['message' => 'success'], 200);



    }


}
