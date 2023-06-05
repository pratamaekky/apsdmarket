<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\Admins;
use App\Http\Controllers\Admin\Products;
use App\Http\Controllers\Admin\Orders;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/cart', [HomeController::class, 'cart']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::post('/submit-checkout', [HomeController::class, 'submitcheckout'])->name('submitcheckout');
Route::get('/detail/{id}', [HomeController::class, 'detail']);

Route::get('/cms/login', [UserController::class, 'login'])->name('login');
Route::post('/doLogin', [UserController::class, 'doLogin'])->name('doLogin');
Route::get('/cms/staff', [Admins::class, 'staff']);

Route::prefix('cms')->middleware(['auth'])->group(function() {
    Route::get('/products', [Products::class, 'lists']);
    Route::get('/products/data', [Products::class, 'data']);
    Route::get('/products/add', [Products::class, 'add']);
    Route::post('/products/save', [Products::class, 'save'])->name('saveProduct');
    Route::get('/products/edit/{id}', [Products::class, 'edit']);
    Route::post('/products/update/{id}', [Products::class, 'update']);
    Route::post('/products/delete', [Products::class, 'delete']);
    
    Route::get('/orders', [Orders::class, 'lists']);
    Route::get('/orders/data', [Orders::class, 'data']);
    Route::post('/orders/delete', [Orders::class, 'delete']);
});

Route::get('/cms/admins', [Admins::class, 'index']);
Route::get('/cms/logout', [UserController::class, 'logout'])->name('logout');
Route::prefix('cms')->middleware(['auth', 'isAdmin'])->group(function() {
    Route::get('/', [UserController::class, 'login']);
    Route::get('/admins/lists', [Admins::class, 'lists']);
    Route::get('/admins/data', [Admins::class, 'data']);
    Route::get('/admins/add', [Admins::class, 'add']);
    Route::post('/admins/save', [Admins::class, 'save'])->name('saveAdmin');
});
