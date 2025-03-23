@extends('partials.master')


@section('content')
    <h1 class="mb-4">Public Product List</h1>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="max-height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: ${{ $product->price }}</p>
                    <p class="card-text">Quantity: {{ $product->quantity }}</p>
                    <a href="{{ route('public_products.show', $product->id) }}" class="btn btn-primary" style="background-color: #4caf50; border-color: #4caf50;">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
