@extends('layouts.app')

@section('content')
    <h1>Add Coupon</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coupons.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" name="code" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="discount">Discount (%):</label>
            <input type="number" name="discount" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="expiration_date">Expiration Date:</label>
            <input type="date" name="expiration_date" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Coupon</button>
    </form>
@endsection
