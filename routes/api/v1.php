<?php

use App\Http\Controllers\Api\V1\Carts\Coupons\DeleteController as CouponsDeleteController;
use App\Http\Controllers\Api\V1\Carts\Coupons\StoreController as CouponsStoreController;
use App\Http\Controllers\Api\V1\Carts\IndexController as CartsIndexController;
use App\Http\Controllers\Api\V1\Carts\Products\DeleteController as DeleteProductController;
use App\Http\Controllers\Api\V1\Carts\Products\StoreController as ProductsStoreController;
use App\Http\Controllers\Api\V1\Carts\Products\UpdateController as UpdateProductController;
use App\Http\Controllers\Api\V1\Carts\StoreController;
use App\Http\Controllers\Api\V1\Products\IndexController;
use App\Http\Controllers\Api\V1\Products\ShowController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('products')->as('products:')->group(function() {
    Route::get('/', IndexController::class)->name('index');
    Route::get('{key}', ShowController::class)->name('show');
});

/**
 * Cart Routess
 */ 
Route::prefix('carts')->as('carts:')->group(function() {
    Route::get('/', CartsIndexController::class)->name('index');

    Route::post('/', StoreController::class)->name('store');

    Route::post('{cart:uuid}/products', ProductsStoreController::class)->name('products:store');

    /**
     * Update Quantity
     */
    Route::patch('{cart:uuid}/products/{item:uuid}', UpdateProductController::class)->name('products:update');

    /**
     * Delete an item from cart
     */
    Route::delete('{cart:uuid}/products/{item:uuid}', DeleteProductController::class)->name('products:delete');

     /**
     * Add a coupon to our cart
     */
    Route::post('{cart:uuid}/coupons', CouponsStoreController::class)->name('coupons:store');

    /**
     * Remove a coupon from our cart
     */
    Route::delete('{cart:uuid}/coupons/{uuid}', CouponsDeleteController::class)->name('coupons:delete');
});