<?php

namespace App\Http\Controllers\Helpers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;

trait CheckoutHelpers
{
    private function createPaymentIntent($stripe, $amount)
    {
        return $stripe->paymentIntents->create([
            'amount' => $amount * 100,
            'currency' => 'usd',
            'payment_method_types' => ['card'],
        ]);
    }

    private function validateInventory($items)
    {
        foreach ($items as $item) {
            $product = Product::find($item['product_id']);

            if (!$product || $product->quantity < $item['quantity']) {
                throw new \Exception("{$product->name} is out of stock");
            }
        }
    }

    private function createOrder($data, $cart)
    {
        return Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'user_id' => auth()->id(),
            'total' => $cart['totals']['total'],
            'email' => $data['email'],
            'shipping_address' => $data['shipping_address'],
            'subtotal' => $cart['totals']['subtotal'],
            'tax' => $cart['totals']['tax'],
            'shipping' => $cart['totals']['shipping'],
            'payment_method' => $data['payment_method'],
            'status' => 'PROCESSING',
        ]);
    }

    private function finalizeCheckout($order, $cart)
    {
        foreach ($cart['items'] as $item) {
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);

            Product::where('id', $item['product_id'])->decrement('quantity', $item['quantity']);
        }

        app(Cart::class)->clear();
    }

    private function getShippingOptions()
    {
        return [
            'standard' => [
                'name' => 'Standard Shipping',
                'cost' => 5.99,
                'eta' => '3-5 buisness days'
            ],
            'express' => [
                'name' => 'Express Shipping',
                'cost' => 12.99,
                'eta' => '1-2 buisness days'
            ]
        ];
    }
}
