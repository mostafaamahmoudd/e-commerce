<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        if (!app('laravel-cart')->getQuantity()) {
            return redirect()->route('products.index');
        }

        return view('checkout');
    }

    public function store()
    {
        $items = app('laravel-cart')->getCart();

        //
    }
}
