<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CheckoutHelpers;
use App\Http\Requests\CheckoutRequest;
use App\Models\Order;
use App\Support\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    use CheckoutHelpers;

    public function showCheckout()
    {
        $cart = app(Cart::class)->getData();

        if (empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        return view('checkout', [
            'cart' => $cart,
            'shippingOptions' => $this->getShippingOptions(),
        ]);
    }

    public function processPayment(CheckoutRequest $request)
    {
        $cart = app(Cart::class)->getData();

        try {
            return DB::transaction(function () use ($request, $cart) {
                $this->validateInventory($cart['items']);

                $order = $this->createOrder($request->all(), $cart);

                $this->finalizeCheckout($order, $cart);

                return redirect()->route('cart.success', $order);
            });

        } catch (\Exception $e) {
            Log::error('Checkout failed: ' . $e->getMessage());
            return redirect()->route('checkout')->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    public function handleSuccess(Order $order)
    {
        return view('checkout.success', [
            'order' => $order,
        ]);
    }

    public function handleFailure()
    {
        return view('checkout.failure')->with('error', 'Payment processing failed.');
    }
}
