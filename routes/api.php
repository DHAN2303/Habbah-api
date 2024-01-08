<?php

use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\MarketingBoxController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderProductController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Product\ProductImageController;
use App\Http\Controllers\Api\OrderStatusController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\WishListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\Authentication\AuthenticationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('test', [ProductController::class, "trandata"]);

Route::namespace('Api')->prefix('v1')->group(function(){

    /****************** Authentication ******************/
    Route::namespace('Authentication')->prefix('auth')->group(function (){
        Route::post('register', [AuthenticationController::class, 'register']);
        Route::post('login',[AuthenticationController::class, 'login']);
        Route::get('logout',[AuthenticationController::class, 'logout']);
    });


    /****************** Product ******************/
        Route::prefix('products')->group(function (){

            Route::get('/',[ProductController::class,'listProduct']);
            Route::get('/{product}',[ProductController::class,'getProductById']);
            Route::post('create',[ProductController::class,'createProduct']);
            Route::patch('update/{product}',[ProductController::class,'updateProduct']);
            Route::delete('/{product}/delete',[ProductController::class,'deleteProduct']);
        });



    /****************** ProductImage ******************/

         Route::prefix('productimages')->group(function (){

        Route::get('/{productImages}/image',[ProductImageController::class,'getProductImageById']);
        Route::get('/{productImages}/allimages',[ProductImageController::class,'getAllProductImagesById']);
        Route::post('uploadimages',[ProductImageController::class,'uploadImages']);
        Route::patch('updateimages/{productImages}',[ProductImageController::class,'updateImages']);
        Route::delete('deleteimages/{productimages}',[ProductImageController::class,'deleteImages']);
         });



    /****************** Cart ******************/
    Route::middleware('auth:api')->prefix('cart')->group(function (){


             Route::get('user/{cart}',[CartController::class,'getCartByUserId']);
             Route::get('/{cart}',[CartController::class,'getCartById']);
             Route::post('create',[CartController::class,'createCart']);
             Route::patch('update/{cart}',[CartController::class,'updateCart']);
             Route::delete('delete/{cart}',[CartController::class,'deleteCart']);
    });


    /****************** MarketingBox ******************/
    Route::prefix('marketingBox')->group(function (){


        Route::get('/{marketingBox}',[MarketingBoxController::class,'getMarketingBoxById']);
        Route::post('create',[MarketingBoxController::class,'createMarketingBox']);
        Route::patch('update/{marketingBox}',[MarketingBoxController::class,'updateMarketingBox']);
        Route::delete('/{marketingBox}/delete',[MarketingBoxController::class,'deleteMarketingBox']);
    });


    /****************** Order ******************/

    Route::middleware('auth:api')->prefix('order')->group(function (){


        Route::get('/{order}',[OrderController::class,'getOrderById']);
        Route::get('user/{order}',[OrderController::class,'getOrderByUserId']);
        Route::post('create',[OrderController::class,'createOrder']);
        Route::patch('update/{order}',[OrderController::class,'updateOrder']);
        Route::delete('delete/{order}',[OrderController::class,'deleteOrder']);
    });


    /****************** OrderProduct ******************/
    Route::middleware('auth:api')->prefix('orderProduct')->group(function (){


        Route::get('/{orderProduct}',[OrderProductController::class,'getOrderProductById']);
        Route::post('create',[OrderProductController::class,'createOrderProduct']);
        Route::patch('update/{orderProduct}',[OrderProductController::class,'updateOrderProduct']);
        Route::delete('delete/{orderProduct}',[OrderProductController::class,'deleteOrderProduct']);
    });


    /****************** OrderStatus ******************/
    Route::prefix('orderStatus')->group(function (){


        Route::get('/{orderStatus}',[OrderStatusController::class,'getOrderStatusById']);
        Route::post('create',[OrderStatusController::class,'createOrderStatus']);
        Route::patch('update/{orderStatus}',[OrderStatusController::class,'updateOrderStatus']);
        Route::delete('delete/{orderStatus}',[OrderStatusController::class,'deleteOrderStatus']);
    });

    /****************** WishList ******************/
    Route::middleware('auth:api')->prefix('wishList')->group(function(){

        Route::get('/{wishList}',[WishListController::class,'getWishList']);
        Route::post('create',[WishListController::class,'createWishList']);

    });

    /****************** Category ******************/
    Route::prefix('category')->group(function (){


        Route::get('/{category}',[CategoryController::class,'getCategoryById']);
        Route::post('create',[CategoryController::class,'createCategory']);
        Route::patch('update/{category}',[CategoryController::class,'updateCategory']);
        Route::delete('delete/{category}',[CategoryController::class,'deleteCategory']);
    });

    /****************** SubCategory ******************/

    Route::prefix('subCategory')->group(function (){

        Route::get('/{subCategory}',[SubCategoryController::class,'getSubCategoryById']);
        Route::post('create',[SubCategoryController::class,'createSubCategory']);
        Route::patch('update/{subCategory}',[SubCategoryController::class,'updateSubCategory']);
        Route::delete('delete/{subCategory}',[SubCategoryController::class,'deleteSubCategory']);
    });

});



