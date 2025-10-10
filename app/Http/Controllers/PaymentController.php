<?php

namespace App\Http\Controllers;

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
        $tierPrice = Tier::where('title', $validated['plan'])->first(['price'])->price . 00;
        $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
        $charge = $stripe->charges->create([
            'amount' => $tierPrice,
            'currency' => 'usd',
            'source' => $request->stripeToken,
        ]);

        if ($charge) {
            $user = Auth::user();
            $user->tier = $tier;
            $user->save();

            return redirect()->route('plan.index')->with('success', 'Your account has been upgraded successfully.');

        } else {
            return 'Error';
        }
    }
}
