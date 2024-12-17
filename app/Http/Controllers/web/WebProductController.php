<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'user_id' => Auth::user()['id']
        ]);
        return response()->json([
            'message' => 'Product added successfully!',
        ], 201);
    }


    function edit(Product $product)
    {

        
        echo "Update here";
    }
}
