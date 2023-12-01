<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductCategory\Http\Controllers\ProductCategoryController;

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

Route::prefix('productcategory')->group(function() {
    Route::get('/', 'ProductCategoryController@index');
});
Route::get('searchCategory' , [ProductCategoryController::class , 'searchCategory'])->name('searchCategory');
Route::middleware('auth' , 'admin')->group(function () {
Route::get('allCategories' , [ProductCategoryController::class , 'allCategories'])->name('allCategories');
Route::get('createCategory' , [ProductCategoryController::class , 'create'])->name('createCategory');
Route::post('storeCategory' , [ProductCategoryController::class , 'store'])->name('storeCategory');
Route::get('/editCategory/{id}' , [ProductCategoryController::class , 'edit'])->name('editCategory');
Route::post('updateCategory/{id}' , [ProductCategoryController::class , 'update'])->name('updateCategory');
Route::delete('/deleteCategory/{id}' , [ProductCategoryController::class , 'destroy'])->name('deleteCategory');
}); 