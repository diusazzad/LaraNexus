<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SettingsController;

Route::get('/', function () {
    return view('welcome');
});

// Products & Orders
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::post('/orders/create', [OrderController::class, 'store']);

// User Management
Route::get('/admin/users', [UserController::class, 'index']);
Route::get('/admin/users/{user}', [UserController::class, 'show']);
Route::post('/admin/users', [UserController::class, 'store']);

// Categories & Payments
Route::get('/api/categories', [CategoryController::class, 'list']);
Route::post('/api/payments/process', [PaymentController::class, 'process']);

// System Settings
Route::get('/settings/general', [SettingsController::class, 'general']);
Route::get('/settings/security', [SettingsController::class, 'security']);
