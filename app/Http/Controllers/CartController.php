<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Support\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = app(Cart::class)->getData();

        return view('cart.index', [
            'cart' => $cart,
            'products' => Product::findMany(array_column($cart['items'], 'product_id')),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        try {
            $product = Product::findOrFail($request->get('product_id'));

            if($product->is_available) {
                return back()->with('error', 'This product is currently unavailable');
            }

            // $cart = $this->getCartData();
            // $existingItemKey = $this->findCartItemKey($product->getKey(), $request->get('product_id'));

            // if($existingItemKey) {
            //     $quantity = $cart['items'][$existingItemKey]['quantity'] + $request->get('quantity');

            //     if ($product->quantity < $quantity) {
            //         return back()->with('error', 'This product is currently out of stock');
            //     }

            //     $cart['items'][$existingItemKey]['quantity'] = $quantity;
            // }

            if ($product->quantity < $request->get('quantity')) {
                return back()->with('error', 'This product is currently out of stock');
            }

            $cart['items'][] = [
                'product_id' => $request->get('product_id'),
                'quantity' => $request->get('quantity'),
                'price' => $product->price,
            ];

            // $this->saveCart($cart);
            // $this->syncCartToDatabase();

            return back()->with('success', 'Item added to cart');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('cart.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $itemKey)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10',
        ]);

        try {
            $cart = app(Cart::class)->getData();

            if (!isset($cart['items'][$itemKey])) {
                return back()->with('error', 'Item not found');
            }

            $product = Product::find($cart['items'][$itemKey]['product_id']);

            if ($product->quantity < $request->get('quantity')) {
                return back()->with('error', 'This product is currently out of stock');
            }

            $cart['items'][$itemKey]['quantity'] = $request->get('quantity');

            // $this->saveCart($cart);
            // $this->syncCartToDatabase();

            return back()->with('success', 'Item updated');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($itemKey)
    {
        try {
            $cart = app(Cart::class)->getData();

            if (!isset($cart['items'][$itemKey])) {
                unset($cart['items'][$itemKey]);

                $cart['items'] = array_values($cart['items']);

                // $this->saveCart($cart);
                // $this->syncCartToDatabase();
            }

            return back()->with('success', 'Item deleted');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // private function saveCart($cart)
    // {
    //     $cart['totals'] = $this->calculateTotals($cart);

    //     if (Auth::check()) {
    //         Auth::user()->cart()->updateOrCreate([], [
    //             'content' => $cart,
    //         ]);
    //     } else {
    //         Session::put('cart', $cart);
    //     }
    // }

    // private function findCartItemKey($productId, $productKey)
    // {
    //     $cart = app(Cart::class)->getData();

    //     foreach ($cart['items'] as $key => $item) {
    //         if ($item['product_id'] == $productId && $item['product_key'] == $productKey) {
    //             return $key;
    //         }
    //     }

    //     return null;
    // }

    // private function calculateTotals($cart)
    // {
    //     $subtotal = 0;
    //     foreach ($cart['items'] as $key) {
    //         $subtotal += $key['price'] * $key['quantity'];
    //     }

    //     $tax = $subtotal * 0.1;

    //     return [
    //         'subtotal' => $subtotal,
    //         'shipping' => 5.99,
    //         'tax' => $tax,
    //         'total' => max(0, $subtotal - 5.99 + $tax)
    //     ];
    // }

    // private function syncCartToDatabase()
    // {
    //     if (Auth::check()) {
    //         $sessionCart = Session::get('cart');

    //         if ($sessionCart) {
    //             $dbCart = Auth::user()->cart()->firstOrCreate();
    //             $merggedCarts = $this->mergeCarts($dbCart->content, $sessionCart);

    //             $dbCart->update(['content' => $merggedCarts]);

    //             Session::forget('cart');
    //         }
    //     }
    // }

    // private function mergeCarts($dbCart, $sessionCart)
    // {
    //     $mergedItems = $dbCart['items'] ?? [];

    //     foreach ($sessionCart['items'] as $sessionItem) {
    //         $exists = false;

    //         foreach ($mergedItems as &$mergedItem) {
    //             if ($this->isSameItem($mergedItem, $sessionItem)) {
    //                 $mergedItem = $this->mergeItemQuantities($mergedItem, $sessionItem);
    //                 $exists = true;
    //                 break;
    //             }
    //         }

    //         if (!$exists) {
    //             $mergedItems[] = $this->validateItem($sessionItem);
    //         }
    //     }

    //     $mergedItems = array_filter(array_map(function($item) {
    //         return $this->validateItem($item);
    //     }, $mergedItems));

    //     return [
    //         'items' => array_values($mergedItems),
    //         'totals' => $this->calculateTotals(['items' => $mergedItems])
    //     ];
    // }

    // private function isSameItem($item1, $item2)
    // {
    //     return $item1['product_id'] === $item2['product_id'];
    // }

    // private function mergeItemQuantities($existingItem, $newItem)
    // {
    //     $product = Product::find($existingItem['product_id']);

    //     if (!$product || !$product->is_available) {
    //         return null;
    //     }

    //     $newQuantity = $existingItem['quantity'] + $newItem['quantity'];
    //     $maxQuantity = $product->stock;

    //     return [
    //         'product_id' => $existingItem['product_id'],
    //         'quantity' => min($newQuantity, $maxQuantity),
    //         'price' => $product->price,
    //     ];
    // }

    // private function validateItem($item)
    // {
    //     $product = Product::find($item['product_id']);

    //     if (!$product || !$product->is_available) {
    //         return null;
    //     }

    //     $maxQuantity = $product->quantity;

    //     return [
    //         'product_id' => $item['product_id'],
    //         'quantity' => min($item['quantity'], $maxQuantity),
    //         'price' => $product->price,
    //     ];
    // }
}
