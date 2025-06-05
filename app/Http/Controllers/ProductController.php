<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ProductController extends Controller
{
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



    public function create()
    {
        return view('products.create');
    }

   
    public function store(Request $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('img', $request->file('image')->getClientOriginalName(), 'public');
        }

        Product::create(array_merge($request->only(['name', 'description', 'price', 'quantity']), ['image' => $imagePath]));

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Request $request)
    {
        $products = Product::query();

        if ($request->has('with_trashed')) {
            $products->onlyTrashed();
        } else {
            $products->where('deleted_at', null);
        }

        $products = $products->get();

        return view('product.index', compact('products'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

  
    public function update(Request $request, Product $product)
    {
        $data = $request->only(['name', 'description', 'price', 'quantity']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storeAs('img', $request->file('image')->getClientOriginalName(), 'public');
            $data['image'] = $imagePath; 
        }

        $product->update($data); 
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Product $product)
    {
        if ($request->has('with_trashed')) {
            $product->forceDelete();
            return redirect()->route('products.index', ['with_trashed' => 1])->with('success', 'Product permanently deleted.');
        } else {
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
