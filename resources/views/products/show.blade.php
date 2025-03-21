@extends('layouts.app')

@section('content')
<div class="card shadow">
    <div class="card-header">
        Product Details
    </div>
    <div class="card-body d-flex">
        <div class="product-details">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"><strong>Description:</strong> {{ $product->description }}</p>
            <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
            <p class="card-text"><strong>Quantity:</strong> {{ $product->quantity }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
        <div class="product-image" style="margin-left: 20px;">
            <img src="{{ asset('/storage/' . $product->image) }}" alt="{{ $product->name }}" style="width: 300px;">

        </div>
    </div>
</div>
@endsection

<style>
    .card-body.d-flex {
        display: flex;
        justify-content: space-between;
        flex-direction: row;
    }

    .product-details {
        flex-grow: 1;
    }

    .product-image {
        margin-right: 20px;
    }

    .product-image img {
        width: 300px;
    }
</style>