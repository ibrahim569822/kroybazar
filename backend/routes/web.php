<?php

use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware(['auth', 'role:1'])->get('/admin', fn () => view('admin.dashboard'));
Route::middleware(['auth', 'role:2'])->get('/vendor', fn () => view('vendor.dashboard'));
Route::middleware(['auth', 'role:3'])->get('/shop', fn () => view('shop.dashboard'));