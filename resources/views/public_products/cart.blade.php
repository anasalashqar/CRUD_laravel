@extends('partials.master')

@section('content')
<style>
    .cart-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem;
    }

    .cart-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 1.5rem;
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }

    .cart-table th,
    .cart-table td {
        padding: 12px;
        border-bottom: 1px solid #e0e0e0;
        text-align: center;
    }

    .cart-table th {
        background-color: #f9f9f9;
        font-weight: 600;
    }

    .quantity-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 6px 10px;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 4px;
    }

    .qty-input {
        width: 50px;
        text-align: center;
        margin: 0 5px;
        padding: 6px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .delete-btn {
        background-color: #e53935;
        color: white;
        border: none;
        padding: 6px 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    .checkout-btn {
        background-color: #4caf50;
        color: white;
        padding: 10px 20px;
        font-size: 1rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .total-section {
        font-size: 1.2rem;
        font-weight: bold;
        margin-top: 1rem;
    }
</style>

<div class="cart-container">
    <div class="cart-title">Shopping Cart</div>

    <table class="cart-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php $totalPrice = 0; @endphp

            @if($cartItems && count($cartItems) > 0)
            @foreach($cartItems as $cartItem)
            @php
            $totalPrice += $cartItem->product->price * $cartItem->quantity;
            @endphp
            <tr>
                <td>
                    <img src="{{ asset('storage/'. $cartItem->product->image) }}" width="60" height="60" alt="{{ $cartItem->product->name }}" style="object-fit: cover; border-radius: 6px;" />
                </td>
                <td>{{ $cartItem->product->name }}</td>
                <td>${{ $cartItem->product->price }}</td>
                <td>
                    <div class="quantity-wrapper">
                        <button type="button" class="qty-btn quantity-left-minus" data-id="{{ $cartItem->product->id }}">−</button>
                        <input type="text" class="qty-input qty cart_update" name="quantity" id="quantity{{ $cartItem->product->id }}" value="{{ $cartItem->quantity }}" min="1" max="{{ $cartItem->product->quantity }}" data-id="{{ $cartItem->product->id }}">
                        <button type="button" class="qty-btn quantity-right-plus" data-id="{{ $cartItem->product->id }}">+</button>
                    </div>
                </td>
                <td>${{ $cartItem->product->price * $cartItem->quantity }}</td>
                <td>
                    <button class="delete-btn remove-from-cart" data-id="{{ $cartItem->product->id }}">
                        🗑 Remove
                    </button>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="6"><strong>No items in cart</strong></td>
            </tr>
            @endif
        </tbody>
    </table>

    <div class="total-section">
        Grand Total: <span class="grand-total">${{ $totalPrice }}</span>
    </div>

    <div style="margin-top: 1.5rem;">
        <a href="{{ route('checkout') }}" class="checkout-btn">Proceed to Checkout</a>
    </div>
</div>
@endsection