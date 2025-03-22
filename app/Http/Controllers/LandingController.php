<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        // Get 3 best-selling or latest products (adjust logic as needed)
        $products = Product::take(3)->get();

        return view('landing', compact('products'));
    }
}
