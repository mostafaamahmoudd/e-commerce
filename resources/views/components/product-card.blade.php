                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{ route('products.show', $product) }}">
                                                    <img class="default-img" src="{{ url('/images/shop/product-2-1.jpg') }}" alt="{{ $product->name }}">
                                                    <img class="hover-img" src="{{ url('/images/shop/product-2-2.jpg') }}" alt="{{ $product->name }}">
                                                </a>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Hot</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            @if($product->category()->exists())
                                                <div class="product-category">
                                                    <a href="{{ route('categories.show', $product->category) }}">{{ $product->category->name }}</a>
                                                </div>
                                            @endif
                                            <h2><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h2>
                                            <div class="product-price">
                                                <span>${{ $product->price }} </span>
                                            </div>
                                            <div class="product-action-1 show">
                                                <form method="POST" action="{{ route('cart.store', $product) }}" style="display: inline;">
                                                    @csrf
                                                    <a href="#"
                                                    class="action-btn hover-up"
                                                    aria-label="Add To Cart"
                                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                                        <i class="fi-rs-shopping-bag-add"></i>
                                                    </a>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
