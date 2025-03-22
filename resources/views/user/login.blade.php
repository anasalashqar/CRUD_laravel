<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Welcome Back</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .login-box {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .welcome-text {
            text-align: center;
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="position-absolute top-0 start-0 p-4">
        <a href="/" class="btn btn-outline-light">
            ← Home
        </a>
    </div>

    <div class="login-box">
        <h2 class="welcome-text">👋 Welcome Back!</h2>

        @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg" placeholder="you@example.com" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">Log In</button>
        </form>

        <div class="text-center mt-3">
            <a href="/register" class="text-decoration-none">Don't have an account? <strong>Register</strong></a>
        </div>
    </div>
</body>

</html>