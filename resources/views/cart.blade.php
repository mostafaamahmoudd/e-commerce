<x-app-layout>
    <x-page-header title="Cart" />

        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(app('laravel-cart')->getCart() as $cartItem)
                                        @php($item = app('laravel-cart')->getItem($cartItem))
                                        <tr>
                                            <td class="image product-thumbnail"><img src="{{ url('/images/shop/product-1-2.jpg') }}" alt="{{ $item->name }}"></td>
                                            <td class="product-des product-name">
                                                <h5 class="product-name"><a href="{{ route('products.show', $item) }}">{{ $item->name }}</a></h5>
                                            </td>
                                            <td class="price" data-title="Price"><span>${{ $item->price }} </span></td>
                                            <td class="text-center" data-title="Stock">
                                                {{ $cartItem['quantity'] }}
                                            </td>
                                            <td class="text-right" data-title="Cart">
                                                <span>${{ $cartItem['quantity'] * $item->price }} </span>
                                            </td>
                                            <td class="action" data-title="Remove">
                                                <a href="{{ route('cart.remove', $item) }}" class="text-muted"><i class="fi-rs-trash"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Products Added</td>
                                        </tr>
                                    @endforelse

                                    @if(app('laravel-cart')->getQuantity() > 0)
                                        <tr>
                                            <td colspan="6" class="text-end">
                                                <a href="{{ route('cart.clear') }}" class="text-muted"> <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-action text-end">
                            <a class="btn" href="{{ route('products.index') }}"><i class="fi-rs-shopping-bag mr-10"></i>Continue Shopping</a>

                            @if(app('laravel-cart')->getQuantity() > 0)
                                <a class="btn" href="{{ route('checkout') }}"><i class="fi-rs-shopping-bag mr-10"></i>Checkout</a>
                            @endif
                        </div>
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                    </div>
                </div>
            </div>
        </section>
</x-app-layout>
