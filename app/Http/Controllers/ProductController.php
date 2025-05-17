<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
//    public function create()
//    {
//        return view('products.create');
//    }

    /**
     * Store a newly created resource in storage.
     */
//    public function store(Request $request)
//    {
//        Product::create($request->validate([
//            'name' => 'required',
//            'price' => 'required',
//            'description' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'category_id' => 'required',
//            'quantity' => 'required',
//        ]));
//
//        return redirect()->route('products.index');
//    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $products = Product::paginate(10);

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('media')
            ->limit(3)
            ->get();

        return view('products.show', compact(
            'products',
            'relatedProducts'
        ));
    }

    public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:255',
            'category' => 'nullable|exists:categories,id'
        ]);

        $query = Product::query()
            ->where('name', 'like', "%".$request->get('query')."%");

        if ($categoryId = $request->get('category')) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Update the specified resource in storage.
     */
//    public function update(ProductRequest $request, string $id)
//    {
//        Product::update($request->validate([
//            'name' => 'required',
//            'price' => 'required',
//            'description' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
//            'category_id' => 'required',
//            'quantity' => 'required',
//        ]));
//
//        return redirect()->route('products.index');
//    }

    /**
     * Remove the specified resource from storage.
     */
//    public function destroy(string $id)
//    {
//        Product::destroy($id);
//
//        return redirect()->route('products.index');
//    }
}
