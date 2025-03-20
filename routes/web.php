<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'Hello World';
});

Route::resource('products', ProductController::class);
Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
