<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    // * Signup
    public function signup(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'tier' => ['required', Rule::in(Tier::pluck('id')->toArray())],
            'role' => 'user',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $tierPrice = Tier::findorFail($validated['tier'])->price;
        $amount_in_cents = (int) round($tierPrice * 100);

        if ($validated['tier'] != 1) {
            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
            $charge = $stripe->charges->create([
                'amount' => $amount_in_cents,
                'currency' => 'usd',
                'source' => $request->stripeToken,
            ]);
        }

        $role = $validated['role'] ?? 'user';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'tier' => $validated['tier'],
            'role' => $role,
            'password' => Hash::make($validated['password']),
        ]);

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
            $plan = Plan::where('user_id', Auth::id())->first();

            if ($plan) {
                $lastUpdated = Carbon::parse($plan->updated_at);
                $now = Carbon::now();

                if (! $lastUpdated->isSameMonth($now)) {
                    $user = Auth::user();
                    $user->tier = 1;
                    $user->save();
                }
            }

            return redirect()->intended('dashboard');
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
