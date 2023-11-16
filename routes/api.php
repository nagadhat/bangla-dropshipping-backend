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
Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::get('get-all-products', [HomeController::class, 'get_all_products']);
Route::get('get-product/{id}', [HomeController::class, 'get_product']);
Route::get('get-all-categories', [HomeController::class, 'get_all_categories']);
Route::get('get-sliders', [HomeController::class, 'get_sliders']);


Route::middleware('auth:api')->group( function () {
    // Order routes
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/{id}', [OrderController::class, 'show']);
    Route::post('orders', [OrderController::class, 'store']);
    Route::put('orders/{id}', [OrderController::class, 'update']);
    Route::delete('orders/{id}', [OrderController::class, 'delete']);

    // Category routes
    Route::get('categories', [CategoryController::class, 'index']);
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

    // Product routes
    // Route::post('add/products', [ProductController::class, 'store']);
});


