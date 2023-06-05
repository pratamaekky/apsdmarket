<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\AdminController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('product/data', [ProductController::class, 'data']);
Route::post('product/save', [ProductController::class, 'save']);
Route::get('product/detail/{id}', [ProductController::class, 'detail']);
Route::post('product/update/{id}', [ProductController::class, 'update']);
Route::post('product/delete', [ProductController::class, 'delete']);

Route::prefix('order')->group(function() {
    Route::get('data', [OrderController::class, 'data']);
    Route::post('delete', [OrderController::class, 'delete']);
});

Route::prefix('admin')->group(function() {
    Route::get('data', [AdminController::class, 'data']);
    Route::post('save', [AdminController::class, 'save']);
    Route::post('delete', [AdminController::class, 'delete']);
});
