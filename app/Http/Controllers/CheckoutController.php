<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helpers\CheckoutHelpers;
use App\Http\Requests\CheckoutRequest;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    use CheckoutHelpers;

    protected $stripe;

    /**
     * @param $stripe
     */
    public function __construct($stripe)
    {
        $this->stripe = $stripe;
    }

    public function showCheckout()
    {
        $cart = app(Cart::class)->getCartData();

        if (empty($cart['items'])) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        return view('checkout', [
            'cart' => $cart,
            'paymentIntent' => $this->createPaymentIntent($this->stripe, $cart['totals']['total']),
            'shippingOptions' => $this->getShippingOptions(),
        ]);
    }

    public function processPayment(CheckoutRequest $request)
    {
        $validated = request()->validate([
            'email' => 'required|email',
            'address' => 'required|array',
            'billingAddress' => 'required|array',
            'payment_method' => 'required|string',
            'terms' => 'accepted',
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                $cart = app(Cart::class)->getCartData();
                $this->validateInventory($cart['items']);

                $payment = $this->stripe->paymentIntents->create([
                    'amount' => $cart['totals']['total'],
                    'currency' => 'usd',
                    'payment_method' => $validated['payment_method'],
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'metadata' => [
                        'cart_id' => session()->getId(),
                    ]
                ]);

                if ($payment->status !== 'succeeded') {
                    throw new \Exception('Payment failed: ' . $payment->last_payment_error?->message);
                }

                $order = $this->createOrder($validated, $cart);

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
