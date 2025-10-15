<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::where('google_id', $googleUser->getId())
                ->orWhere('email', $googleUser->getEmail())
                ->first();

            if (! $user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'tier_id' => 1,
                    'role' => 'user',
                    'password' => bcrypt(Str::random(16)),
                ]);
            } else {
                if (! $user->google_id) {
                    $user->update(['google_id' => $googleUser->getId()]);
                }
            }

            Auth::login($user);

            $plan = Plan::where('user_id', Auth::id())->first();

            if ($plan) {
                $lastUpdated = Carbon::parse($plan->updated_at);
                $now = Carbon::now();

                if (! $lastUpdated->isSameMonth($now)) {
                    $user = Auth::user();
                    $user->tier_id = 1;
                    $user->save();
                }
            }

            return redirect()->route('dashboard');
        } catch (\Exception $e) {
            return redirect()->route('login-form')->with('error', 'Google login failed: '.$e->getMessage());
        }
    }
}
