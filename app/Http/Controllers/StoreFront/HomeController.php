<?php

namespace App\Http\Controllers\StoreFront;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::status('active')
            ->with('category')
            ->limit(10)
            ->get();

        return view('store-front.index', compact('products'));
    }
}
