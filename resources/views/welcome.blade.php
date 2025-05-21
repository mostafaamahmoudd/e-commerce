<x-app-layout>
        <section class="home-slider position-relative pt-50">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2">
                                    <h4 class="animated">Trade-in offer</h4>
                                    <h2 class="animated fw-900">Supper value deals</h2>
                                    <h1 class="animated fw-900 text-brand">On all products</h1>
                                    <p class="animated">Save more with coupons & up to 70% off</p>
                                    <a class="animated btn btn-brush btn-brush-3" href="{{ route('products.index') }}"> Shop Now </a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1">
                                    <img class="animated slider-1-1" src="{{ url('/images/slider/slider-1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>

        <section class="featured section-padding position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features hover-up">
                            <img src="{{ url('/images/theme/icons/feature-1.png') }}" alt="">
                            <h4 class="bg-1">Free Shipping</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features hover-up">
                            <img src="{{ url('/images/theme/icons/feature-2.png') }}" alt="">
                            <h4 class="bg-3">Online Order</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features hover-up">
                            <img src="{{ url('/images/theme/icons/feature-3.png') }}" alt="">
                            <h4 class="bg-2">Save Money</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features hover-up">
                            <img src="{{ url('/images/theme/icons/feature-4.png') }}" alt="">
                            <h4 class="bg-4">Promotions</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features hover-up">
                            <img src="{{ url('/images/theme/icons/feature-5.png') }}" alt="">
                            <h4 class="bg-5">Happy Sell</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-md-3 mb-lg-0">
                        <div class="banner-features hover-up">
                            <img src="{{ url('/images/theme/icons/feature-6.png') }}" alt="">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="product-tabs section-padding position-relative">
            <div class="container">
                        <div class="row product-grid-4">
                            @foreach($products as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <x-product-card :product="$product" />
                                </div>
                            @endforeach
                        </div>
            </div>
        </section>

        <section class="popular-categories section-padding mt-15 mb-25">
            <div class="container">
                <h3 class="section-title mb-20"><span>Popular</span> Categories</h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows"></div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @foreach($popularCategories as $category)
                            <div class="card-1">
                                <figure class="img-hover-scale overflow-hidden">
                                    <a href="{{ route('categories.show', $category) }}">
                                        <img src="{{ url('/images/shop/category-thumb-1.jpg') }}" alt="{{ $category->name }}">
                                    </a>
                                </figure>
                                <h5>
                                    <a href="{{ route('categories.show', $category) }}">
                                        {{ $category->name }}
                                    </a>
                                </h5>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
</x-app-layout>
