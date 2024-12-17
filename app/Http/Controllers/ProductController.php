<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    //Section 4 method that return all products
    //List all products
    function all()
    {
        $products = Product::paginate(10);
        return $products;
    }
}
