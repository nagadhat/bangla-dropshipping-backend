<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// route for authintication

    Route::match(['get', 'post'], '/', [AuthController::class, 'authLogin'])->middleware('guest')->name('auth_login');
    Route::get('/registration', [AuthController::class, 'authRegistration'])->name('auth_registration');

   
Route::group(['middleware' => 'disable'], function(){
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    });
});


// route for admin dashboard 
// Route::group([ 'middleware' => 'auth'], function() {
//     Route::get('/admin-dashboard', [DashboardController::class, 'index'])->middleware('disable')->name('admin_dashboard');
//     Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });


