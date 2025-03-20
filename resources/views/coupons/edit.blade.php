@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Coupon</h1>
    <form action="{{ route('coupons.update', $coupon->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="code">Coupon Code</label>
            <input type="text" name="code" class="form-control" value="{{ $coupon->code }}" required>
        </div>
        <div class="form-group">
            <label for="discount">Discount</label>
            <input type="number" name="discount" class="form-control" value="{{ $coupon->discount }}" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="valid_from">Valid From</label>
            <input type="date" name="valid_from" class="form-control" value="{{ $coupon->valid_from }}" required>
        </div>
        <div class="form-group">
            <label for="valid_to">Valid To</label>
            <input type="date" name="valid_to" class="form-control" value="{{ $coupon->valid_to }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection