@extends('layouts.app')

@section('title', 'View Category')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Category Details</h1>
        <div>
            <a href="{{ route('categories.edit', $category) }}" class="btn btn-primary me-2">
                <i class="fas fa-edit me-1"></i> Edit
            </a>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-1"></i> Back to Categories
            </a>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div class="mb-4">
                <h5>Name</h5>
                <p class="lead">{{ $category->name }}</p>
            </div>
            
            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $category->description ?: 'No description available.' }}</p>
            </div>
            
            <div class="mb-4">
                <h5>Status</h5>
                @if ($category->active)
                <span class="badge bg-success">Active</span>
                @else
                <span class="badge bg-danger">Inactive</span>
                @endif
            </div>
            
            <div class="mb-4">
                <h5>Created At</h5>
                <p>{{ $category->created_at->format('M d, Y H:i') }}</p>
            </div>
            
            <div class="mb-4">
                <h5>Updated At</h5>
                <p>{{ $category->updated_at->format('M d, Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection