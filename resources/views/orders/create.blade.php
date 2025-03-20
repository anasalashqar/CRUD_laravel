@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add New Order</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
        </div>

        <div class="mb-3">
            <label for="customer_email" class="form-label">Email</label>
            <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}" required>
        </div>

        <div class="mb-3">
            <label for="customer_phone" class="form-label">Phone</label>
            <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
        </div>

        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="number" name="total_price" class="form-control" value="{{ old('total_price') }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
