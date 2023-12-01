<?php





use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Modules\UserAuthentication\Http\Controllers\UserAuthenticationController;

Route::prefix('userauthentication')->group(function() {
    Route::get('/', 'UserAuthenticationController@index');
});



Route::get('/', function () {
    return view('userauthentication::index');
});

// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });
Route::get('index' , [UserAuthenticationController::class , 'index'])->name('index');
Route::get('/' , [UserAuthenticationController::class , 'index']);
Route::get('loginform' , [UserAuthenticationController::class , 'loginform'])->name('loginform');
Route::get('signup' , [UserAuthenticationController::class , 'signup'])->name('signup');
Route::get('search',[UserAuthenticationController::class , 'search'])->name('search');

Route::middleware('auth')->group(function () {
    Route::get('profile' , [UserAuthenticationController::class , 'profile'])->name('profile');
    Route::post('changeProfileImage/{id}' , [UserAuthenticationController::class , 'changeProfileImage'])->name('changeProfileImage');
});

