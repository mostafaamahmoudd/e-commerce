<?php

namespace App\Support;

class CartManager
{
    /**
     * The session driver of laravel cart.
     */
    public function createSessionDriver(): CartSession
    {
        return new CartSession();
    }
}
