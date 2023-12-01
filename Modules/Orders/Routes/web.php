<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\Http\Controllers\OrdersController;
use Modules\Orders\Http\Controllers\PaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('shop' , [OrdersController::class , 'shop'])->name('shop');
Route::get('filterByCat/{id}' , [OrdersController::class , 'filterByCat'])->name('filterByCat');

Route::middleware('auth')->group(function () {
Route::get('cart/{id}' , [OrdersController::class , 'cart'])->name('cart');
Route::post('addToCart/{id}' , [OrdersController::class , 'addToCart'])->name('addToCart');
Route::get('orders' , [OrdersController::class , 'orders'])->name('orders');

Route::middleware('haveOrders')->group(function () {
Route::post('updateQuantity/{id}' , [OrdersController::class , 'updateQuantity'])->name('updateQuantity');
Route::delete('deleteOrder/{id}' , [OrdersController::class , 'deleteOrder'])->name('deleteOrder');
Route::delete('deleteallOrders' , [OrdersController::class , 'deleteallOrders'])->name('deleteallOrders');
Route::get('checkout' , [OrdersController::class , 'checkout'])->name('checkout');
Route::post('cashOnDelivery' , [PaymentController::class , 'cashOnDelivery'])->name('cashOnDelivery');
});

});