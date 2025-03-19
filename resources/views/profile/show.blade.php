<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .profile-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: flex-start;
            max-width: 800px;
        }
        .profile-info {
            flex: 2;
            margin-right: 30px;
        }
        .profile-info h1 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .profile-info p {
            margin-bottom: 15px;
            line-height: 1.6;
            color: #555;
        }
        .profile-info strong {
            font-weight: bold;
            color: #333;
        }
        .profile-photo {
            flex: 1;
            max-width: 200px;
            border-radius: 50%;
            border: 5px solid #eee;
        }
        .edit-profile-form {
            margin-top: 30px;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .edit-profile-form h2 {
            color: #333;
            margin-top: 0;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        .form-group input[type="text"],
        .form-group textarea,
        .form-group select,
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1em;
        }
        .form-group textarea {
            height: 120px;
        }
        button[type="submit"] {
            padding: 12px 20px;
            background-color: pink;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }
        button[type="submit"]:hover {
            background-color: purple;
        }
    </style>
</head>
<body>
  <div class="profile-container">
        <div class="profile-info">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Address:</strong> {{ $user->address }}</p>
            <p><strong>Mobile Number:</strong> {{ $user->mobile_number }}</p>
            <p><strong>Gender:</strong> {{ $user->gender }}</p>
        </div>
        <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('no-pic.jpg') }}" alt="Profile Photo" class="profile-photo">
    </div>


    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="edit-profile-form">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address">{{ $user->address }}</textarea>
        </div>
        <div class="form-group">
            <label for="mobile_number">Mobile Number:</label>
            <input type="text" id="mobile_number" name="mobile_number" value="{{ $user->mobile_number }}">
        </div>
        <div class="form-group">
            <label for="gender">Gender:</label>
            <select id="gender" name="gender">
                <option value="">Select Gender</option>
                <option value="male" {{ $user->gender === 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender === 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $user->gender === 'other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="form-group">
            <label for="photo">Profile Photo:</label>
            <input type="file" id="photo" name="photo">
            @if($user->photo)
                <img src="{{ asset('storage/' . $user->photo) }}" alt="Current Profile Photo" style="max-width: 100px;">
            @endif
        </div>
        <button type="submit">Update Profile</button>
    </form>
</body>
</html>
