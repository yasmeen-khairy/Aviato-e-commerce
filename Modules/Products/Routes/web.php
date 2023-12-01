<?php

use Illuminate\Support\Facades\Route;
use Modules\Products\Http\Controllers\ProductsController;

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

Route::prefix('products')->group(function() {
    Route::get('/', 'ProductsController@index');
});

Route::middleware('auth' , 'admin')->group(function () {
Route::get('allProducts' , [ProductsController::class , 'allProducts'])->name('allProducts'); 
Route::get('createProduct' , [ProductsController::class , 'create'])->name('createProduct'); 
Route::post('storeProduct' , [ProductsController::class , 'store'])->name('storeProduct'); 
Route::get('editProduct/{id}' , [ProductsController::class , 'edit'])->name('editProduct'); 
Route::post('updateProduct/{id}' , [ProductsController::class , 'update'])->name('updateProduct'); 
Route::delete('deleteProduct/{id}' , [ProductsController::class , 'destroy'])->name('deleteProduct'); 
});