@extends('layouts.public')

@section('content')
    <h1>Checkout</h1>

    <form action="{{ route('place.order') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" required>
        </div>
        <div class="mb-3">
            <label for="customer_email" class="form-label">Customer Email</label>
            <input type="email" class="form-control" id="customer_email" name="customer_email" required>
        </div>
        <div class="mb-3">
            <label for="customer_phone" class="form-label">Customer Phone</label>
            <input type="tel" class="form-control" id="customer_phone" name="customer_phone" required>
        </div>
        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="text" class="form-control" id="total_price" name="total_price" value="{{ $totalPrice ?? '' }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary" style="background-color: #4caf50;">Confirm Order</button>
    </form>
@endsection
