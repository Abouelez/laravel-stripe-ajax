<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Stripe\Stripe;

class WebProductController extends ProductController
{
    function index()
    {
        $products = $this->all();
        return view('products.index', ['products' => $products]);
    }

    function create()
    {
        return view('products.create');
    }

    function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'name' => $request['name'],
            'price' => (int) ($request['price'] * 100),
            'quantity' => $request['quantity'],
            'category_id' => random_int(1, 20),
            'user_id' => $request->user()->id ?? 0
        ]);
        return response()->json([
            'message' => 'Product added successfully!',
        ], 201);
    }

    function edit(Product $product)
    {
        Gate::authorize('update', $product);
        dd('You Can Update this product');
    }

    function delete(Product $product)
    {
        Gate::authorize('delete', $product);
        dd('You Can delete this product');
    }
}
