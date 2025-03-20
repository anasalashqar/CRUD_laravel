<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;


Route::get('/', function () {
    return 'Hello World';
});

Route::group(['prefix' => 'admin'], function () {
    Route::resource('products', ProductController::class);
});

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::resource('coupons', CouponController::class);







