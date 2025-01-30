<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Stripe;

class StripeDeliveryController extends Controller
{
    public function distanceDeliveryStripe()
    {
        return view('generalUsers.delivery.payment.distance_delivery');
    }

    public function distanceDeliveryStripePost(Request $request)
    {
        try {
            $amount = $request->amount;
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            Stripe\Charge::create([
                "amount" => $amount * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Distance Delivery fee"
            ]);

            return redirect()->route('generalUsers.delivery.track')->with('success', 'Delivery created successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
