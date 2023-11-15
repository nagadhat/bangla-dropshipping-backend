<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ProductController;



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

        // route for admin dashboard
        Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

        // route for category
        Route::match(['get', 'post'], '/add/category', [CategoryController::class, 'store'])->name('add_category');
        Route::get('/categories', [CategoryController::class, 'index'])->name('get_categories');

        // route for sub-category
        Route::match(['get', 'post'], '/add/sub-category', [SubCategoryController::class, 'store'])->name('add_sub_category');
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('get_sub_categories');
        

        // route for child-category
         Route::match(['get', 'post'], '/add/child-category', [ChildCategoryController::class, 'store'])->name('add_child_category');
         Route::get('/child-categories', [ChildCategoryController::class, 'index'])->name('get_child_categories');

        // route for product
         Route::match(['get', 'post'], '/add/product', [ProductController::class, 'store'])->name('add_product');
         Route::get('/products', [ProductController::class, 'index'])->name('get_products');
         Route::post('/get-sub-category', [ProductController::class, 'get_sub_category']);
         Route::post('/get-child-category', [ProductController::class, 'get_child_category']);
        
         Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


    });
});



