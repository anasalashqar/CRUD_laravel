@extends('partials.master')

@section('content')
    <div class="container">
        <div class="card shadow">
            <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="max-height: 300px; object-fit: cover;">
            <div class="card-body">
                <h1 class="card-title">{{ $product->name }}</h1>
                <p class="card-text">Price: ${{ $product->price }}</p>
                <p class="card-text">Quantity: {{ $product->quantity }}</p>
                <p class="card-text">Description: {{ $product->description }}</p>
            </div>
        </div>
        <form action="{{ route('cart.add', $product->id) }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $product->id }}" name="id">
            <input type="hidden" value="{{ $product->name }}" name="name">
            <input type="hidden" value="{{ $product->price }}" name="price">
            <input type="hidden" value="{{ $product->image }}" name="image">
            <input type="hidden" value="1" name="quantity">
            <button class="btn btn-success mt-3" style="background-color: #4caf50; border-color: #4caf50;">Add to Cart</button>
        </form>
        <a href="{{ route('public_products.index') }}" class="btn btn-primary mt-3" style="background-color: #4caf50; border-color: #4caf50;">Back to Product List</a>
    </div>
@endsection
