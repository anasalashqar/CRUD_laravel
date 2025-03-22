<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Join Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(to right, #4caf50, #81c784);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
        }

        .register-box {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .join-text {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="position-absolute top-0 start-0 p-4">
        <a href="/" class="btn btn-outline-light">
            ← Home
        </a>
    </div>
    <div class="register-box">
        <h2 class="join-text">🌱 Join the Green Team</h2>
        <p class="text-center text-muted mb-4">Create your account and let's grow together 🌿</p>

        @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif

        <form action="/register" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control form-control-lg" required placeholder="Jane Doe">
            </div>

            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control form-control-lg" required placeholder="you@example.com">
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control form-control-lg" required placeholder="••••••••">
            </div>

            <div class="mb-3">
                <label class="form-label">Phone <span class="text-muted">(optional)</span></label>
                <input type="text" name="phone" class="form-control form-control-lg" placeholder="+1234567890">
            </div>

            <button type="submit" class="btn btn-success btn-lg w-100">Register Now</button>
        </form>

        <div class="text-center mt-3">
            <a href="/login" class="text-decoration-none">Already have an account? <strong>Login</strong></a>
        </div>
    </div>
</body>

</html>