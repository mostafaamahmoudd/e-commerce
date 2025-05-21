<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display list of products.
     */
    public function show(Category $category)
    {
        $products = $category->products()->paginate(10);

        return view('products.index', compact('products'));
    }
}
