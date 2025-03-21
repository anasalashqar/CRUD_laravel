@extends('layouts.app')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Products</h1>
    <p class="mb-4">
        
    </p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Create Product</a>
                <a href="{{ route('products.index', ['with_trashed' => 1]) }}" class="btn btn-secondary mb-3">View Trashed Products</a>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="{{ $product->name }}" width="50">
                                    
                                </td>
                                 <td>
                                    @if(!request()->has('with_trashed'))
                                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i> View</a>
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm delete-product-btn"><i class="fas fa-trash"></i> Delete</button>
                                        </form>
                                    @endif
                                    @if(request()->has('with_trashed'))
                                        <form action="{{ route('products.restore', $product->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">Restore</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this product?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection
