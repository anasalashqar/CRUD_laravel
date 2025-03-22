<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class PublicProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        session(['user_id' => 1]); // Set user_id for testing
        $products = Product::all();

        return view('public_products.index', compact('products'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('public_products.show', compact('product'));
    }

    public function cart()
    {
        $userId = session('user_id'); // Get user_id from session
        $cartItems = \App\Models\Cart::where('user_id', $userId)
            ->with('product')
            ->get();

        return view('public_products.cart', compact('cartItems'));
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        session(['user_id' => 1]); // Ensure user_id is set in session
        $userId = session('user_id'); // Get user_id from session

        $cartItem = \App\Models\Cart::where('user_id', $userId)
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity++;
            $cartItem->save();
        } else {
            \App\Models\Cart::create([
                'user_id' => $userId,
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function updateCart(Request $request)
    {
        if($request->id && $request->quantity){
            $userId = auth()->id(); // Assuming users are authenticated
            $cartItem = \App\Models\Cart::where('user_id', $userId)
                ->where('product_id', $request->id)
                ->first();

            if ($cartItem) {
                $product = Product::find($request->id);
                if ($request->quantity > $product->quantity) {
                    return response()->json(['error' => 'Quantity exceeds available stock'], 400);
                }
                $cartItem->quantity = $request->quantity;
                $cartItem->save();
                session()->flash('success', 'Cart updated successfully');
            }
        }
    }

    public function removefromcart(Request $request)
    {
        if($request->id) {
            $userId = auth()->id(); // Assuming users are authenticated
            \App\Models\Cart::where('user_id', $userId)
                ->where('product_id', $request->id)
                ->delete();

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout()
    {
        $userId = session('user_id'); // Get user_id from session
        $cartItems = \App\Models\Cart::where('user_id', $userId)
            ->with('product')
            ->get();
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        return view('public_products.checkout', compact('cartItems', 'totalPrice'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
        ]);

        $userId = session('user_id'); // Get user_id from session
        $cartItems = \App\Models\Cart::where('user_id', $userId)->get();
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $userId,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'status' => 'pending', // Default status
         ]);

         $orderItems = [];
         foreach ($cartItems as $cartItem) {
             $orderItems[] = [
                 'order_id' => $order->id,
                 'product_id' => $cartItem->product_id,
                 'quantity' => $cartItem->quantity,
                 'price' => $cartItem->product->price,
             ];
             $product = Product::find($cartItem->product_id);
             $product->quantity -= $cartItem->quantity;
             $product->save();
         }
         \DB::table('order_items')->insert($orderItems);

         // Clear the cart for the user
         \App\Models\Cart::where('user_id', $userId)->delete();

         return redirect()->route('public_products.index')->with('success', 'Order placed successfully!');
     }
 }
