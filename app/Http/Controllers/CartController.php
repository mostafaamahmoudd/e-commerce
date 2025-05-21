<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        return view('cart');
    }

    public function store(Request $request, Product $product)
    {
        if (!$product->getQuantity()) {
            return redirect()->back();
        }

        app('laravel-cart')->storeItems([
            [
                'itemable' => $product,
                'quantity' => $request->input('quantity', 1),
            ],
        ]);

        return redirect()->route('cart');
    }

    public function remove(Product $product)
    {
        app('laravel-cart')->removeItem($product);

        return back();
    }

    public function clear()
    {
        app('laravel-cart')->emptyCart();

        return back();
    }
}
