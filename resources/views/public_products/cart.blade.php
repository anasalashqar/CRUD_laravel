@extends('layouts.public')

@section('content')
    <h1>Shopping Cart</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Product Image</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
            @endphp
            @if($cartItems && count($cartItems) > 0)
                @foreach($cartItems as $cartItem)
                    @php
                        $totalPrice += $cartItem->product->price * $cartItem->quantity;
                    @endphp
                    <tr>
                        <td><img src="{{ asset('storage/'. $cartItem->product->image) }}" width="50" height="50" class="img-thumbnail" alt="{{ $cartItem->product->name }}"/></td>
                        <td>{{ $cartItem->product->name }}</td>
                        <td>${{ $cartItem->product->price }}</td>
                        <td>
                            <div class="quantity">
                                 @php
                                     $maxQuantity = $cartItem->product->quantity;
                                 @endphp
                                 <div class="input-group" style="width: 130px;">
                                     <span class="input-group-btn">
                                         <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="quantity" data-id="{{ $cartItem->product->id }}">
                                           <span>-</span>
                                         </button>
                                     </span>
                                     <input type="text" style="text-align: center" id="quantity{{ $cartItem->product->id }}" name="quantity" class="form-control input-number qty cart_update" value="{{ $cartItem->quantity }}" min="1" max="{{ $maxQuantity }}" data-id="{{ $cartItem->product->id }}">
                                     <span class="input-group-btn">
                                         <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="quantity" data-id="{{ $cartItem->product->id }}">
                                             <span>+</span>
                                         </button>
                                     </span>
                                 </div>
                             </div>
                         </td>
                         <td>${{ $cartItem->product->price * $cartItem->quantity }}</td>
                         <td>
                             <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $cartItem->product->id }}" style="cursor: pointer;">
                                 <i class="fa fa-trash-o"></i> Delete
                             </button>
                         </td>
                     </tr>
                 @endforeach
             @else
                 <tr>
                     <td colspan="6"><h3>No items in cart</h3></td>
                 </tr>
             @endif
         </tbody>
     </table>

     <div>
         <strong>Grand Total: <span class="grand-total">${{ $totalPrice }}</span></strong>
     </div>

     <div class="mt-3">
         <a href="{{ route('checkout') }}" class="btn btn-primary">Checkout</a>
     </div>
 @endsection

 @section('scripts')
     <script>
         $(document).ready(function () {

             $(document).on('click', '.quantity-left-minus', function(e){
                 e.preventDefault();
                 var ele = $(this);
                 var input = ele.closest('.input-group').find('.input-number');
                 var currentVal = parseInt(input.val());
                 if (!isNaN(currentVal) && currentVal > input.attr('min')) {
                     input.val(currentVal - 1).change();
                 } else {
                     input.val(input.attr('min'));
                 }
             });

             $(document).on('click', '.quantity-right-plus', function(e){
                 e.preventDefault();
                 var ele = $(this);
                 var input = ele.closest('.input-group').find('.input-number');
                 var currentVal = parseInt(input.val());
                 if (!isNaN(currentVal) && currentVal < input.attr('max')) {
                     input.val(currentVal + 1).change();
                 } else {
                     input.val(input.attr('max'));
                 }
             });


             $(".cart_update").change(function (e) {
                 e.preventDefault();
                 var ele = $(this);
                 $.ajax({
                     url: '{{ route('update.cart') }}',
                     method: "patch",
                     data: {
                         _token: '{{ csrf_token() }}',
                         id: ele.data('id'),
                         quantity: ele.val()
                     },
                     success: function (response) {
                         var row = ele.closest('tr');
                         var price = parseFloat(row.find('td:nth-child(3)').text().replace('$', ''));
                         var quantity = parseInt(ele.val());
                         var total = price * quantity;
                         row.find('td:nth-child(5)').text('$' + total.toFixed(2));

                         var grandTotal = 0;
                         $('.qty').each(function() {
                             var qty = parseInt($(this).val());
                             var prc = parseFloat($(this).closest('tr').find('td:nth-child(3)').text().replace('$', ''));
                             grandTotal += qty * prc;
                         });
                         $('.grand-total').text('$' + grandTotal.toFixed(2));
                     },
                     error: function(xhr, status, error) {
                         alert(xhr.responseJSON.error);
                         var ele = $(".cart_update[data-id='" + ele.data('id') + "']");
                         ele.val(ele.attr('value'));
                     }
                 });
             });

             $(".remove-from-cart").click(function (e) {
                 e.preventDefault();

                 var ele = $(this);
                 if(confirm("Are you sure want to remove?")) {
                     $.ajax({
                         url: '{{ route('remove.from.cart') }}',
                         method: "DELETE",
                         data: {
                             _token: '{{ csrf_token() }}',
                             id: ele.data('id')
                         },
                         success: function (response) {
                             window.location.reload();
                         }
                     });
                 }
             });

         });
     </script>
 @endsection
