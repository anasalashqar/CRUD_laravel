@extends('partials.master')

@section('content')
<div class="container py-4">
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}</p>
                    <h6 class="card-subtitle mb-2 text-muted">${{ number_format($product->price, 2) }}</h6>
                    <form action="{{ route('public_products.show', $product->id) }}" method="GET" class="d-inline">
                        <button type="submit" class="btn btn-success" style="background-color: #4caf50; color: white;">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </button>
                    </form>

                    <button class="btn btn-danger" style="background-color: #4caf50; color: white;">

                        <i class="fa-solid fa-heart"></i>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection