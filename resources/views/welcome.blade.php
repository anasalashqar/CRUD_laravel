<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
</head>

<body>

    <h2>
        @php
        use Illuminate\Support\Facades\Cookie;
        use App\Models\User;

        $user = null;

        if (session()->has('user_id')) {
        $user = \App\Models\User::find(session('user_id'));
        } elseif (Cookie::has('remember_token')) {
        try {
        $token = decrypt(Cookie::get('remember_token'));
        $user = \App\Models\User::where('remember_token', $token)->first();
        } catch (\Exception $e) {
        $user = null;
        }
        }
        @endphp

        <h2>
            Hi {{ $user ? $user->name : 'Guest' }}

            @if ($user)
            <a href="/logout" style="margin-left: 10px;">Logout</a>
            @else
            <a href="/login" style="margin-left: 10px;">Login</a>
            @endif
        </h2>

    </h2>

</body>

</html>