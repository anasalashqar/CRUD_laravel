@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Admin Users</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <!-- Add New Admin Button -->
    <a href="/adminUser/create" class="btn btn-primary mb-3">Add New Admin</a>

    <!-- Admin Users Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $admin)
            <tr>
                <td>{{ $admin->id }}</td>
                <td>{{ $admin->name }}</td>
                <td>{{ $admin->email }}</td>
                <td>{{ ucfirst($admin->role) }}</td>
                <td>{{ $admin->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ url('/adminUser/' . $admin->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>

                    <!-- Delete Button with Modal -->
                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('/adminUser/{{ $admin->id }}')">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Bootstrap Modal for Confirmation -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this admin?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="confirmDeleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript for Setting Delete Action Dynamically -->
<script>
    function confirmDelete(action) {
        let form = document.getElementById('confirmDeleteForm');
        form.action = action; // Set form action dynamically
        let modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
        modal.show(); // Show the modal
    }
</script>

@endsection