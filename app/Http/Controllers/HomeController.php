<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $products = Product::Take(3)->get();
        return view('home.index', compact('products'));
    }
}
