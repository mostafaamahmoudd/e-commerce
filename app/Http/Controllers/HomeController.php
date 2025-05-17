<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);

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
