<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::query();

        if ($request->has('with_trashed')) {
            // Only show trashed products
            $products->onlyTrashed();
        } else {
            // Only show non-trashed products
            $products->where('deleted_at', null);
        }

        $products = $products->get();

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('img', $request->file('image')->getClientOriginalName(), 'public');
        }

        Product::create(array_merge($request->only(['name', 'description', 'price', 'quantity']), ['image' => $imagePath]));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->only(['name', 'description', 'price', 'quantity']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('img', $request->file('image')->getClientOriginalName(), 'public');
            $data['image'] = $imagePath; // Add image path to the data array
        }

        $product->update($data); // Update product with all data (including image if uploaded)
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        if ($request->has('with_trashed')) {
            // Permanent delete from trashed view
            $product->forceDelete();
            return redirect()->route('products.index', ['with_trashed' => 1])->with('success', 'Product permanently deleted.');
        } else {
            // Soft delete from regular view and redirect to trashed
            $product->delete();
            return redirect()->route('products.index', ['with_trashed' => 1])->with('success', 'Product moved to trash.');
        }
    }

    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        Log::info('Product restored: ' . $product->id);
        return redirect()->route('products.index')->with('success', 'Product restored successfully.');
    }
}

