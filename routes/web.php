<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');
Route::get('/search', [App\Http\Controllers\ProductController::class, 'search'])->name('products.search');

Route::resource('cart', CartController::class);

Route::view('/products/{product}', 'products.show');

Route::view('/cart', 'cart');

Route::view('/checkout', 'checkout');

Route::view('/page', 'page');

require __DIR__.'/auth.php';
