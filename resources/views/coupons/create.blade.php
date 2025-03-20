<form action="{{ route('coupons.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="code">Coupon Code</label>
        <input type="text" name="code" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="discount">Discount</label>
        <input type="number" name="discount" class="form-control" step="0.01" required>
    </div>
    <div class="form-group">
        <label for="valid_from">Valid From</label>
        <input type="date" name="valid_from" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="valid_to">Valid To</label>
        <input type="date" name="valid_to" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>