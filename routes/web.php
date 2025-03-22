<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicProductController;
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

Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
Route::resource('coupons', CouponController::class);
Route::get('/product', [ProductController::class, 'index']);






//login
Route::get('/register', [UserController::class, 'showRegisterForm']); // Show register form
Route::post('/register', [UserController::class, 'register']); // Handle registration
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login'); // Show login form
Route::post('/login', [UserController::class, 'login']); // Handle login
Route::get('/logout', [UserController::class, 'logout']); // Handle logout

//admin_users

// Route::get('/adminUser', [AdminUserController::class, 'index'])->name('admin_users.index'); // Show all users
// Route::get('/admin_users/create', [AdminUserController::class, 'create'])->name('admin_users.create'); // Show create user form
// Route::post('/admin_users', [AdminUserController::class, 'store'])->name('admin_users.store'); // Handle new user creation
// Route::get('/admin_users/{user}/edit', [AdminUserController::class, 'edit'])->name('admin_users.edit'); // Show edit user form
// Route::put('/admin_users/{user}', [AdminUserController::class, 'update'])->name('admin_users.update'); // Handle update user
// Route::delete('/admin_users/{user}', [AdminUserController::class, 'delete'])->name('admin_users.destroy'); // Handle user deletion
Route::get('/public_products', [PublicProductController::class, 'index'])->name('public_products.index');
Route::get('/public_products/{product}', [PublicProductController::class, 'show'])->name('public_products.show');

Route::resource('orders', OrderController::class);


Route::get('/cart', [PublicProductController::class, 'cart'])->name('cart');
Route::get('/checkout', [PublicProductController::class, 'checkout'])->name('checkout');
Route::post('/add-to-cart/{id}', [PublicProductController::class, 'addToCart'])->name('cart.add');
Route::patch('/update-cart', [PublicProductController::class, 'updateCart'])->name('update.cart');
Route::delete('/remove-from-cart', [PublicProductController::class, 'removeFromCart'])->name('remove.from.cart');
Route::post('/place-order', [PublicProductController::class, 'placeOrder'])->name('place.order');

Route::get('/adminUser', [AdminUserController::class, 'index'])->name('adminUser.index'); // Show all users
Route::get('/adminUser/create', [AdminUserController::class, 'create'])->name('adminUser.create'); // Show create user form
Route::post('/adminUser', [AdminUserController::class, 'store'])->name('adminUser.store'); // Handle new user creation
Route::get('/adminUser/{user}/edit', [AdminUserController::class, 'edit'])->name('adminUser.edit'); // Show edit user form
Route::put('/adminUser/{user}', [AdminUserController::class, 'update'])->name('adminUser.update'); // Handle update user
Route::delete('/adminUser/{user}', [AdminUserController::class, 'delete'])->name('adminUser.destroy'); // Handle user deletion

// Route::resource('orders', OrderController::class);


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

