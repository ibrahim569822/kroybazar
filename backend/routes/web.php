<?php
use App\Http\Controllers\Web\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth', 'role:1'])->get('/admin', fn () => 'Admin Dashboard');
Route::middleware(['auth', 'role:2'])->get('/vendor', fn () => 'Vendor Dashboard');
Route::middleware(['auth', 'role:3'])->get('/shop', fn () => 'Shop Dashboard');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/preview', fn () => view('vendor.dashboard'));