<?php

use Illuminate\Support\Facades\Route;
use Modules\AdminDashboard\Http\Controllers\AdminDashboardController;

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

Route::prefix('admindashboard')->group(function() {
    Route::get('/', 'AdminDashboardController@index');
});

Route::middleware('admin' , 'auth')->group(function () {
    //users
Route::get('allUsers' , [AdminDashboardController::class , 'allUsers'])->name('allUsers');
Route::get('userOrders/{id}' , [AdminDashboardController::class , 'userOrders'])->name('userOrders');
Route::get('ordersDetails/{id}' , [AdminDashboardController::class , 'ordersDetails'])->name('ordersDetails');

    //admins
Route::get('admindashboard' , [AdminDashboardController::class , 'index'])->name('adminDashboard');
Route::get('allAdmins' , [AdminDashboardController::class , 'allAdmins'])->name('allAdmins');
Route::get('addAdminForm' , [AdminDashboardController::class , 'addAdminForm'])->name('addAdminForm');
Route::post('addAdmin' , [AdminDashboardController::class , 'addAdmin'])->name('addAdmin');
Route::delete('deleteAdmin/{id}' , [AdminDashboardController::class , 'deleteAdmin'])->name('deleteAdmin');
});