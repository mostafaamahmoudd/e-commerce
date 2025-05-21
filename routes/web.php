<?php

use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('welcome');

Route::get('/categories/{category}', [App\Http\Controllers\CategoryController::class, 'show'])
    ->name('categories.show');

Route::resource('/products', App\Http\Controllers\ProductController::class)
    ->only('index', 'show');

Route::get('/cart', [App\Http\Controllers\CartController::class, 'show'])
    ->name('cart');

Route::post('/cart/{product}', [App\Http\Controllers\CartController::class, 'store'])
    ->name('cart.store');

Route::get('/cart/{product}/remove', [App\Http\Controllers\CartController::class, 'remove'])
    ->name('cart.remove');

Route::get('/cart/clear', [App\Http\Controllers\CartController::class, 'clear'])
    ->name('cart.clear');

Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'show'])
    ->name('checkout');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'store'])
    ->middleware('auth');

Route::resource('order', \App\Http\Controllers\OrderController::class);

Route::view('/pages/privacy-policy', 'pages.privacy-policy')
    ->name('pages.privacy-policy');

Route::view('/pages/terms-conditions', 'pages.terms-conditions')
    ->name('pages.terms-conditions');

require __DIR__.'/auth.php';
