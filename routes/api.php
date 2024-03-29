<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ChildCategoryController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\SliderController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// user authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('get-users', [AuthController::class, 'index'])->name('all.users');

Route::get('get-all-products', [ProductController::class, 'get_all_products']);
Route::get('get-product/{id}', [ProductController::class, 'get_product']);
Route::get('get-product/{id}', [ProductController::class, 'get_product']);

Route::get('get-products-by-category/{slug}/{id}', [ProductController::class, 'products_by_category']);
Route::get('get-products-by-subcategory/{slug}/{id}', [ProductController::class, 'products_by_subcategory']);
Route::get('get-products-by-childcategory/{slug}/{id}', [ProductController::class, 'products_by_childcategory']);

Route::get('get-all-categories', [CategoryController::class, 'get_all_categories']);
Route::get('get-sliders', [SliderController::class, 'get_sliders']);

Route::get('categories', [CategoryController::class, 'index']);

Route::middleware('auth:api')->group( function () {
    // Order routes
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::put('orders/{id}', [OrderController::class, 'update']);
    Route::delete('orders/{id}', [OrderController::class, 'delete']);

    // Category routes
    
    Route::post('add/category', [CategoryController::class, 'store']);
    Route::put('update/category/{id}', [CategoryController::class, 'update']);
    Route::delete('delete/category/{id}', [CategoryController::class, 'delete']);

    // Sub-Category routes
    Route::get('sub-categories/{id}', [SubCategoryController::class, 'index']);
    Route::post('add/sub-category', [SubCategoryController::class, 'store']);
    Route::put('update/sub-category/{id}', [SubCategoryController::class, 'update']);
    Route::delete('delete/sub-category/{id}', [SubCategoryController::class, 'delete']);

    // Child-Category routes
    Route::post('add/child-category', [ChildCategoryController::class, 'store']);
    Route::put('update/child-category/{id}', [ChildCategoryController::class, 'update']);
    Route::delete('delete/child-category/{id}', [ChildCategoryController::class, 'delete']);

    //review routes
    Route::post('add/review', [ReviewController::class, 'store']);

    // Product routes
    // Route::post('add/products', [ProductController::class, 'store']);
});




