<?php

namespace App\Http\Controllers;

use App\Models\Tier;
use App\Models\Plan;
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
            $user->tier = $tier;
            $user->save();

            Plan::updateOrCreate(
                ['user_id' => Auth::id()],
                ['user_id' => Auth::id()]
            );

            return redirect()->route('plan.index')->with('success', 'Your account has been upgraded successfully.');

        } else {
            return 'Error';
        }
    }
}
