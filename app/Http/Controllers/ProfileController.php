<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(User $user)
    {
        return view('profile.show', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'mobile_number' => 'nullable|string|max:20',
            'gender' => 'nullable|string|in:male,female,other',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle photo upload if provided
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('profile_photos', 'public');
            $validatedData['photo'] = $photoPath;
        }

        // Update the user's profile information
        $user->update($validatedData);

        // Redirect back to the profile page with a success message
        return redirect()->route('profile.show', $user->id)->with('success', 'Profile updated successfully!');
    }
}
