<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('welcome');

Route::view('/products/{product}', 'products.show');

Route::view('/cart', 'cart');

Route::view('/checkout', 'checkout');

Route::view('/page', 'page');

require __DIR__.'/auth.php';
