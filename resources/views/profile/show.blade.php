@extends('partials.master')

@section('content')
<style>
    body {
        background-color: #f4f4f4;
        color: #000;
    }

    .tabs {
        max-width: 900px;
        margin: 40px auto;
        background: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .tab-buttons {
        display: flex;
        border-bottom: 2px solid #4caf50;
    }

    .tab-buttons button {
        flex: 1;
        padding: 15px;
        background: #e8f5e9;
        border: none;
        font-weight: bold;
        cursor: pointer;
        transition: background 0.3s;
    }

    .tab-buttons button.active {
        background: #4caf50;
        color: white;
    }

    .tab-content {
        padding: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .btn-green {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 1rem;
    }

    .readonly {
        background: #f1f1f1;
    }
</style>

<div class="tabs">
    <div class="tab-buttons">
        <button class="active" onclick="switchTab('profile')">Profile Settings</button>
        <button onclick="switchTab('orders')">Order History</button>
    </div>

    <div class="tab-content" id="profile-tab">
        <form action="/profile/update/{{ $user->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>User ID</label>
                <input type="text" class="form-control readonly" value="{{ $user->id }}" readonly>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control readonly" value="{{ $user->email }}" readonly>
            </div>
            <div class="form-group">
                <label>Role</label>
                <input type="text" class="form-control readonly" value="{{ $user->role }}" readonly>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>
            <button type="submit" class="btn-green">Update Profile</button>
        </form>
    </div>

    <div class="tab-content" id="orders-tab" style="display: none;">
        <h4>Your Order History</h4>
        <p>(Order history will be displayed here...)</p>
    </div>
</div>
<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="successModalLabel">Success</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ session('success') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<script>
    function switchTab(tab) {
        document.getElementById('profile-tab').style.display = tab === 'profile' ? 'block' : 'none';
        document.getElementById('orders-tab').style.display = tab === 'orders' ? 'block' : 'none';

        const buttons = document.querySelectorAll('.tab-buttons button');
        buttons.forEach(btn => btn.classList.remove('active'));
        buttons[tab === 'profile' ? 0 : 1].classList.add('active');
    }
</script>
@if (session('success'))
<script>
    window.addEventListener('DOMContentLoaded', () => {
        const successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();
    });
</script>
@endif

@endsection