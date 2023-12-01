<?php

use Illuminate\Http\Request;
use Modules\Orders\Http\Controllers\apiOrderController;

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

Route::middleware('auth:api')->get('/orders', function (Request $request) {
    return $request->user();
    Route::delete('deleteOrderFromCart/{id}' , [apiOrderController::class , 'delete']);
});

Route::get('allOrders/{id}' , [apiOrderController::class , 'all']);
Route::post('addToCart/{id}' , [apiOrderController::class , 'create']);