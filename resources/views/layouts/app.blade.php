<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="main">
                {{ $slot }}
            </main>

            <footer class="main">
                <section class="section-padding footer-mid">
                    <div class="container pt-15 pb-20">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="widget-about font-md mb-md-5 mb-lg-0">
                                    <div class="logo logo-width-1 wow fadeIn animated">
                                        <a href="{{ route('welcome') }}">
                                            Ecommerce
                                        </a>
                                    </div>
                                    <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                                    <p class="wow fadeIn animated">
                                        <strong>Address: </strong>562 Wellington Road
                                    </p>
                                    <p class="wow fadeIn animated">
                                        <strong>Phone: </strong>+1 0000-000-000
                                    </p>
                                    <p class="wow fadeIn animated">
                                        <strong>Email: </strong>contact@surfsidemedia.in
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3">
                                <h5 class="widget-title wow fadeIn animated">About</h5>
                                <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                                    <li><a href="{{ route('pages.privacy-policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('pages.terms-conditions') }}">Terms &amp; Conditions</a></li>
                                </ul>
                            </div>
                            @auth
                                <div class="col-lg-2  col-md-3">
                                    <h5 class="widget-title wow fadeIn animated">My Account</h5>
                                    <ul class="footer-list wow fadeIn animated">
                                        <li><a href="#">My Account</a></li>
                                        <li><a href="{{ route('cart') }}">View Cart</a></li>
                                    </ul>
                                </div>
                            @endauth
                        </div>
                    </div>
                </section>
                <div class="container pb-20 wow fadeIn animated mob-center">
                    <div class="row">
                        <div class="col-12 mb-20">
                            <div class="footer-bottom"></div>
                        </div>
                        <div class="col-lg-6">
                            <p class="float-md-left font-sm text-muted mb-0">
                                <a href="privacy-policy.html">Privacy Policy</a> | <a href="terms-conditions.html">Terms & Conditions</a>
                            </p>
                        </div>
                        <div class="col-lg-6">
                            <p class="text-lg-end text-start font-sm text-muted mb-0">
                                &copy; <strong class="text-brand">Ecommerce</strong> All rights reserved
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
