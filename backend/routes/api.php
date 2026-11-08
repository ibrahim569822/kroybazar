<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Admin\AccountController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function () {
    return response()->json(['app' => 'KroyBazar', 'status' => 'ok']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware(['auth:sanctum', 'role:1'])->get('/admin/ping', fn () => ['area' => 'admin']);
Route::middleware(['auth:sanctum', 'role:2'])->get('/vendor/ping', fn () => ['area' => 'vendor']);
Route::middleware(['auth:sanctum', 'role:3'])->get('/shop/ping', fn () => ['area' => 'shop']);
Route::middleware(['auth:sanctum', 'role:1'])->prefix('admin')->group(function () {
    Route::get('/accounts/pending', [AccountController::class, 'pending']);
    Route::patch('/accounts/{user}/approve', [AccountController::class, 'approve']);
    Route::patch('/accounts/{user}/reject', [AccountController::class, 'reject']);
});
