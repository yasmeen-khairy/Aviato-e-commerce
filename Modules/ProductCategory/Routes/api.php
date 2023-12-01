<?php

// use App\Http\Controllers\apiCategoryController;
use Modules\ProductCategory\Http\Controllers\apiCategoryController;

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

Route::middleware('auth:api')->get('/productcategory', function (Request $request) {
    return $request->user();
});



Route::get('Categoryall' , [apiCategoryController::class , 'all']);
Route::post('Categorycreate' , [apiCategoryController::class , 'create']);
Route::post('Categoryupdate/{id}' , [apiCategoryController::class , 'update']);
Route::delete('Categorydelete/{id}' , [apiCategoryController::class , 'delete']);