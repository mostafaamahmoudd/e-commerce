<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::take(6)->get();

        $newArrivals = Product::query()
            ->latest()
            ->limit(12)
            ->get();

        $popularCategories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(8)
            ->get();

        return view('welcome', compact(
            'products',
            'popularCategories',
            'newArrivals',
        ));
    }
}
