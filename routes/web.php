<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BestsellersController;

Route::get('/', [LandingController::class, 'index']);
Route::get('/bestsellers', [BestsellersController::class, 'index'])->name('bestsellers.index');


Route::group(['prefix' => 'admin'], function () {
    Route::resource('products', ProductController::class);
});

Route::get('/services', function () {
    return view('services');
});



Route::resource('coupons', CouponController::class);

//login
Route::get('/register', [UserController::class, 'showRegisterForm']); // Show register form
Route::post('/register', [UserController::class, 'register']); // Handle registration
Route::get('/login', [UserController::class, 'showLoginForm']); // Show login form
Route::post('/login', [UserController::class, 'login']); // Handle login
Route::get('/logout', [UserController::class, 'logout']); // Handle logout

//admin_users
Route::get('/adminUser', [AdminUserController::class, 'index'])->name('admin_users.index'); // Show all users
Route::get('/admin_users/create', [AdminUserController::class, 'create'])->name('admin_users.create'); // Show create user form
Route::post('/admin_users', [AdminUserController::class, 'store'])->name('admin_users.store'); // Handle new user creation
Route::get('/admin_users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin_users.edit'); // Show edit user form
Route::put('/admin_users/{user}', [AdminUserController::class, 'update'])->name('admin_users.update'); // Handle update user
Route::delete('/admin_users/{user}', [AdminUserController::class, 'delete'])->name('admin_users.destroy'); // Handle user deletion

Route::resource('orders', OrderController::class);

