<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\ChildCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\BrandController;



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

// route for admin authintication
Route::match(['get', 'post'], '/', [AuthController::class, 'authLogin'])->name('auth_login')->middleware('guest');
Route::get('/registration', [AuthController::class, 'authRegistration'])->name('auth_registration');

   
Route::group(['middleware' => 'disable'], function(){
    Route::group(['middleware' => 'auth'], function(){

        // route for admin dashboard
        Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

        // route for category
        Route::match(['get', 'post'], '/add/category', [CategoryController::class, 'store'])->name('add_category');
        Route::get('/categories', [CategoryController::class, 'index'])->name('get_categories');
        Route::match(['get', 'post'], '/edit/category/{id}', [CategoryController::class, 'update'])->name('edit_category');
        Route::get('/delete/category/{id}', [CategoryController::class, 'delete'])->name('delete_category');

        // route for sub-category
        Route::match(['get', 'post'], '/add/sub-category', [SubCategoryController::class, 'store'])->name('add_sub_category');
        Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('get_sub_categories');
        Route::match(['get', 'post'], '/edit/sub-category/{id}', [SubCategoryController::class, 'update'])->name('edit_sub_category');
        Route::get('/delete/sub-category/{id}', [SubCategoryController::class, 'delete'])->name('delete_sub_category');

        // route for child-category
         Route::match(['get', 'post'], '/add/child-category', [ChildCategoryController::class, 'store'])->name('add_child_category');
         Route::get('/child-categories', [ChildCategoryController::class, 'index'])->name('get_child_categories');

        // Routes for brand
         Route::match(['get', 'post'], '/add/brand', [BrandController::class, 'store'])->name('add_brand');
         Route::get('/brands', [BrandController::class, 'index'])->name('get_brands');
         Route::match(['get', 'post'], '/edit/brand/{id}', [BrandController::class, 'update'])->name('edit_brand');
         Route::get('/delete/brand/{id}', [BrandController::class, 'delete'])->name('delete_brand');
         Route::get('/change-status/{id}', [BrandController::class, 'changeStatus'])->name('change_status');
       
         // route for slider
         Route::match(['get', 'post'], '/add/slider', [SliderController::class, 'store'])->name('add_slider');
         Route::get('/sliders', [SliderController::class, 'index'])->name('get_sliders');
         

        // route for product
         Route::match(['get', 'post'], '/add/product', [ProductController::class, 'store'])->name('add_product');
         Route::get('/products', [ProductController::class, 'index'])->name('get_products');
         Route::match(['get', 'post'], '/edit/product/{id}', [ProductController::class, 'update'])->name('edit_product');
        Route::get('/delete/product/{id}', [ProductController::class, 'delete'])->name('delete_product');
         Route::post('/get-sub-category', [ProductController::class, 'get_sub_category']);
         Route::post('/get-child-category', [ProductController::class, 'get_child_category']);
        
         Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    });
});



