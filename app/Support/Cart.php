<?php

namespace App\Support;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart
{
    public function getData()
    {
        if (Auth::check()) {
            return Auth::user()->cart()->firstOrCreate();
        }

        return Session::get('cart', [
            'items' => [],
            'total' => [],
        ]);
    }

    public function clear()
    {
        if (Auth::check()) {
            Auth::user()->cart()->delete();
            return;
        }

        Session::forget('cart');
    }
}
