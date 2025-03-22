<?php

use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BestsellersController;
use App\Http\Controllers\ProfileController;
use Symfony\Component\HttpKernel\Profiler\Profile;

Route::get('/', [LandingController::class, 'index']);
Route::get('/bestsellers', [BestsellersController::class, 'index'])->name('bestsellers.index');


Route::resource('products', ProductController::class);
Route::post('products/{product}/restore', [ProductController::class, 'restore'])->name('products.restore');

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
Route::get('/adminUser', [AdminUserController::class, 'index'])->name('adminUser.index'); // Show all users
Route::get('/adminUser/create', [AdminUserController::class, 'create'])->name('adminUser.create'); // Show create user form
Route::post('/adminUser', [AdminUserController::class, 'store'])->name('adminUser.store'); // Handle new user creation
Route::get('/adminUser/{user}/edit', [AdminUserController::class, 'edit'])->name('adminUser.edit'); // Show edit user form
Route::put('/adminUser/{user}', [AdminUserController::class, 'update'])->name('adminUser.update'); // Handle update user
Route::delete('/adminUser/{user}', [AdminUserController::class, 'delete'])->name('adminUser.destroy'); // Handle user deletion

Route::resource('orders', OrderController::class);


//contac-us and about-us routes
Route::get('/contactus', function () {
    return view('contactus.contactus');
});

Route::get('/aboutus', function () {
    return view('aboutus.aboutus');
});

// profile section
Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');