<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    /**
     * Show all admin users.
     */
    public function index()
    {
        $users = User::all();
        return view('adminUser.index', compact('users'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        return view('adminUser.create'); // Create view for adding a new admin user
    }

    /**
     * Store a new admin user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Secure password
        ]);

        return redirect()->route('adminUser.index')->with('success', 'Admin user created successfully.');
    }

    /**
     * Show edit form for a specific admin user.
     */
    public function edit(User $user)
    {
        return view('adminUser.edit', compact('user'));
    }

    /**
     * Update an existing admin user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('adminUser.index')->with('success', 'Admin user updated successfully.');
    }

    /**
     * Delete an admin user.
     */
    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('adminUser.index')->with('success', 'Admin user deleted successfully.');
    }
}
