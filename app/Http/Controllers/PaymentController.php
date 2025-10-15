<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Tier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function getPayment(Request $request)
    {
        $validated = $request->validate([
            'plan' => 'required',
        ]);

        $tier = Tier::where('title', $validated['plan'])->first(['id'])->id;
        $tierPrice = Tier::where('title', $validated['plan'])->first(['price'])->price;
        $amount_in_cents = (int) round($tierPrice * 100);

        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $charge = $stripe->charges->create([
            'amount' => $amount_in_cents,
            'currency' => 'usd',
            'source' => $request->stripeToken,
        ]);

        if ($charge) {
            $user = Auth::user();
            $user->tier_id = $tier;
            $user->save();

            // Check if user's tier title is "advance" (case-insensitive)
            $freeSession = strtolower($user->tier->title) === 'advance';

            Plan::updateOrCreate(
                ['user_id' => $user->id],
                ['free_session' => $freeSession]
            );

            return redirect()->route('plan.index')->with('success', 'Your account has been upgraded successfully.');

        } else {
            return 'Error';
        }
    }
}
