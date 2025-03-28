<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\OrderController;


// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Google login routes
Route::get('auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Redirect based on user type
Route::get('/redirect', [HomeController::class, 'redirect']);



//SELLER ROUTE

Route::get('/view_product', [SellerController::class, 'view_product']);

//add product
Route::post('/add_product', [SellerController::class, 'add_product'])->name('add_product');

//showing product
Route::get('/show_product', [SellerController::class, 'show_product']);

//remove product
Route::delete('/product/{id}', [SellerController::class, 'removeProduct'])->name('product.remove');


//show orders on seller side

Route::get('/show_orders', [SellerController::class, 'show_orders'])->name('show.orders');

//update delivery status
Route::get('/delivered/{id}', [SellerController::class, 'delivered'])->name('delivered');




//USER ROUTE

//shop page
Route::get('/shop_page', [HomeController::class, 'viewshoes'])->name('shop_page');


//search suggestions
Route::get('/search-suggestions', [HomeController::class, 'searchSuggestions']);


    
//product details
Route::get('/product_details/{id}', [HomeController::class, 'showProductDetails'])->name('product_details');

//add wishlist
Route::post('/wishlist', [HomeController::class, 'add_wishlist'])->name('wishlist.add');
Route::get('/wishlist', [HomeController::class, 'view_wishlist'])->name('wishlist.view');
Route::delete('/remove_wishlist/{id}', [HomeController::class, 'remove_wishlist'])->name('remove_wishlist');


//add to cart
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart']);

//display cart
Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('showcart.view');

//remove cart
Route::delete('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('remove_cart');

//checkout

Route::get('/checkout', [HomeController::class, 'checkout']);


Route::get('/cart/checkout', [HomeController::class, 'checkout'])->name('cart.checkout');

Route::post('/order/place', [OrderController::class, 'placeOrder'])->name('order.place');

//DISPLAY ORDER
Route::get('/order_page', [OrderController::class, 'order_page'])->name('order.page');

//checkout result
Route::get('/checkout_result', [OrderController::class, 'checkout_result'])->name('checkout.result');



//ADMIN ROUTES
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/view_top_buyer', [AdminController::class, 'top_buyer']);

Route::get('/activity-logs', [AdminController::class, 'activity_logs'])->name('activity.logs');

Route::get('/show_users', [AdminController::class, 'show_users']);

Route::delete('/users/{id}', [AdminController::class, 'remove_user'])->name('user.remove');


Route::put('/users/{id}', [AdminController::class, 'edit_role'])->name('user.edit_role');
