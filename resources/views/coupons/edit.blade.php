@extends('layouts.app')

@section('content')
    <h1>Edit Coupon</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Code:</label>
            <input type="text" name="code" value="{{ $coupon->code }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="discount">Discount (%):</label>
            <input type="number" name="discount" value="{{ $coupon->discount }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="expiration_date">Expiration Date:</label>
            <input type="date" name="expiration_date" value="{{ $coupon->expiration_date }}" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Update Coupon</button>
    </form>
@endsection
