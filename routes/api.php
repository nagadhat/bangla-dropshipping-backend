<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;




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
Route::get('categories', [CategoryController::class, 'index']);
Route::get('sub-categories/{id}', [SubCategoryController::class, 'index']);


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
     Route::post('add/sub-category', [SubCategoryController::class, 'store']);
     Route::put('update/sub-category/{id}', [SubCategoryController::class, 'update']);
     Route::delete('delete/sub-category/{id}', [SubCategoryController::class, 'delete']);

    // Product routes
    Route::get('products', [ProductController::class, 'index']);
    Route::post('products', [ProductController::class, 'store']);
});


