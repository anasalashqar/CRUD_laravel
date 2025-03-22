<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function showRegisterForm()
    {
        return view('user.register');
    }


    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Encrypt password
            'phone' => $request->phone,
            'role' => 'user',
            'is_active' => true,
        ]);

        return redirect('/login')->with('success', 'Registration successful! Please log in.');
    }

    public function showLoginForm()
    {
        return view('user.login'); // Show the login form
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['message' => 'Invalid email or password']);
        }

        // ✅ Generate and store remember token
        $token = Str::random(60); // Random secure token
        $user->remember_token = $token;
        $user->save();

        // ✅ Set encrypted cookie for 1 week
        Cookie::queue('remember_token', encrypt($token), 60 * 24 * 7);

        // ✅ Set session (optional, if you still want to use session-based login)
        session(['user_id' => $user->id]);

        return redirect('/admin/products')->with('success', 'Login successful!');
    }


    public function logout()
    {
        $user = null;

        // ✅ Try to find user from remember token
        if (Cookie::has('remember_token')) {
            try {
                $token = decrypt(Cookie::get('remember_token'));
                $user = User::where('remember_token', $token)->first();
            } catch (\Exception $e) {
                // Token decrypt failed, ignore
            }
        }

        if ($user) {
            $user->remember_token = null;
            $user->save();
        }

        // ✅ Clear session and cookie
        session()->forget('user_id');
        Cookie::queue(Cookie::forget('remember_token'));

        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
