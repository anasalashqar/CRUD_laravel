<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile using remember_token or session
     */
    public function show()
    {
        $user = null;

        if (session()->has('user_id')) {
            $user = User::find(session('user_id'));
        } elseif (Cookie::has('remember_token')) {
            try {
                $token = Crypt::decrypt(Cookie::get('remember_token'));
                $user = User::where('remember_token', $token)->first();
            } catch (\Exception $e) {
                $user = null;
            }
        }

        if (!$user) {
            return Redirect::to('/login')->withErrors(['message' => 'Unauthorized.']);
        }

        return view('profile.show', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Prevent unauthorized update
        if ((session('user_id') && session('user_id') != $user->id) ||
            (Cookie::has('remember_token') && $user->remember_token !== Crypt::decrypt(Cookie::get('remember_token')))
        ) {
            return redirect('/login')->withErrors(['message' => 'Unauthorized action.']);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully!');
    }
}
