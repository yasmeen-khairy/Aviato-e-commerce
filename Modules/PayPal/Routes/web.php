<?php

use Illuminate\Support\Facades\Route;
use Modules\PayPal\Http\Controllers\PayPalController;

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

Route::prefix('paypal')->group(function() {
    Route::get('/', 'PayPalController@index');
});

Route::middleware('auth' , 'haveOrders')->group(function () {
Route::post('payment' , [PayPalController::class ,'payment'])->name('payment');
Route::get('paymentSuccess' , [PayPalController::class ,'paymentSuccess'])->name('paymentSuccess');
Route::get('paymentCancel' , [PayPalController::class ,'paymentCancel'])->name('paymentCancel');
Route::post('paymentSuccess' , [PayPalController::class , 'paymentSuccess'])->name('paymentSuccess');
});