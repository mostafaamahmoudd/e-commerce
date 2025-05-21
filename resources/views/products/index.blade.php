<x-app-layout>
    <x-page-header title="Shop" />

        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We found <strong class="text-brand">{{ $products->total() }}</strong> items for you!</p>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @foreach($products as $product)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </section>
</x-app-layout>
