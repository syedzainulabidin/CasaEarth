<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // * Signup
    // todo Google Login functionality
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tier' => 'required|in:free,premium,advance',
            'role' => 'in:admin,user', // Optional — defaults to user
            'password' => 'required|string|min:6|confirmed',

            // Card info only if tier is premium or advance
            'card_number' => 'required_if:tier,premium,advance|nullable|string',
            'cvc' => 'required_if:tier,premium,advance|nullable|string',
            'expiry' => 'required_if:tier,premium,advance|nullable|string',
        ]);

        // Set role, defaulting to 'user' if not provided
        $role = $validated['role'] ?? 'user';

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'tier' => $validated['tier'],
            'role' => $role,
            'password' => Hash::make($validated['password']),
        ]);

        // Optionally process/store card details (not implemented here for security reasons)

        return redirect()->route('login')->with('success', 'Account created successfully. You can now log in.');
    }
    // * Login

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard'); // Redirect to intended page or homepage
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }
    // * Log Out

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login-form');
    }
}
