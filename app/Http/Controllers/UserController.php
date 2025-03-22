<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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

        session(['user' => $user]); // Store user session
        return redirect('/admin/products')->with('success', 'Login successful!');
    }


    public function logout()
    {
        session()->forget('user'); // Clear user session
        return redirect('/login')->with('success', 'Logged out successfully.');
    }
}
