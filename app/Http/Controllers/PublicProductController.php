<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class PublicProductController extends Controller
{
    // Unified method to get user ID from encrypted cookie
    private function getUserIdFromCookie()
    {
        try {
            $token = decrypt(Cookie::get('remember_token'));
        } catch (\Exception $e) {
            return null;
        }

        $user = User::where('remember_token', $token)->first();
        return $user ? $user->id : null;
    }

    public function index(Request $request)
    {
        $products = Product::all();
        return view('public_products.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('public_products.show', compact('product'));
    }

    public function cart()
    {
        $userId = $this->getUserIdFromCookie();

        if (!$userId) {
            return redirect()->back()->withErrors(['message' => 'User not authenticated.']);
        }

        $cartItems = \App\Models\Cart::where('user_id', $userId)
            ->with('product')
            ->get();

        return view('public_products.cart', compact('cartItems'));
    }

    public function addToCart($id)
    {
        $userId = $this->getUserIdFromCookie();

        if (!$userId) {
            return redirect()->back()->withErrors(['message' => 'User not authenticated.']);
        }

        $product = Product::findOrFail($id);

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
        $userId = $this->getUserIdFromCookie();

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if ($request->id && $request->quantity) {
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
        $userId = $this->getUserIdFromCookie();

        if (!$userId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        if ($request->id) {
            \App\Models\Cart::where('user_id', $userId)
                ->where('product_id', $request->id)
                ->delete();

            session()->flash('success', 'Product removed successfully');
        }
    }

    public function checkout()
    {
        $userId = $this->getUserIdFromCookie();

        if (!$userId) {
            return redirect()->back()->withErrors(['message' => 'User not authenticated.']);
        }

        $cartItems = \App\Models\Cart::where('user_id', $userId)
            ->with('product')
            ->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('public_products.checkout', compact('cartItems', 'totalPrice'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
        ]);

        $userId = $this->getUserIdFromCookie();

        if (!$userId) {
            return redirect()->back()->withErrors(['message' => 'User not authenticated.']);
        }

        $cartItems = \App\Models\Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->withErrors(['message' => 'Your cart is empty.']);
        }

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
            'status' => 'pending',
        ]);

        $orderItems = [];

        foreach ($cartItems as $cartItem) {
            $orderItems[] = [
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ];

            // Reduce stock
            $product = Product::find($cartItem->product_id);
            $product->quantity -= $cartItem->quantity;
            $product->save();
        }

        DB::table('order_items')->insert($orderItems);
        \App\Models\Cart::where('user_id', $userId)->delete();

        return redirect('/product')->with('success', 'Order placed successfully!');
    }
}
