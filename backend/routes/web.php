<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Admin\AccountController;
use App\Http\Controllers\Web\Admin\CategoryController;

Route::get('/', fn () => redirect('/login'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/register', [AuthController::class, 'showRegister']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware(['auth', 'role:1'])->get('/admin', fn () => view('admin.dashboard'));
Route::middleware(['auth', 'role:2'])->get('/vendor', fn () => view('vendor.dashboard'));
Route::middleware(['auth', 'role:3'])->get('/shop', fn () => view('shop.dashboard'));
Route::middleware(['auth', 'role:1'])->prefix('admin')->group(function () {
    Route::get('/accounts/pending', [AccountController::class, 'pending']);
    Route::patch('/accounts/{user}/approve', [AccountController::class, 'approve']);
    Route::patch('/accounts/{user}/reject', [AccountController::class, 'reject']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
});