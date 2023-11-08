<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Dashboard\DashboardController;
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

// route for admin dashboard 
Route::get('/admin-dashboard', [DashboardController::class, 'index'])->name('admin_dashboard');

// route for authintication
Route::get('/', [AuthController::class, 'authLogin'])->name('auth_login');
Route::get('/registration', [AuthController::class, 'authRegistration'])->name('auth_registration');