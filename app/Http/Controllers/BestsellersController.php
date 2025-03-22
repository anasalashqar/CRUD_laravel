<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class BestsellersController extends Controller
{
    public function index()
    {
        // Get 3 best-selling or latest products from the database
        $products = Product::take(3)->get();

        return view('bestsellers', compact('products'));
    }
}
