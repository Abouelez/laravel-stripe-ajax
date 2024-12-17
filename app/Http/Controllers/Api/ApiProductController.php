<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProductController;
use App\Http\Requests\CreateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiProductController extends ProductController
{
    //Section - 1
    function section_1($message)
    {
        return response()->json([
            'message' => $message
        ], 200);
    }

    //Section 4 method that return all products
    //List all products
    function index()
    {
        $products = $this->all();
        return response()->json($products, 200);
    }

    function store(CreateProductRequest $request)
    {
        $product = Product::create([
            'name' => $request['name'],
            'price' => (int) ($request['price'] * 100),
            'quantity' => $request['quantity'],
            'category_id' => random_int(1, 20),
            'user_id' => Auth::user()['id']
        ], 201);
    }
}
