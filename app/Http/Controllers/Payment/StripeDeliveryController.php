<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Stripe\Charge;

class StripeDeliveryController extends Controller
{
    public function distanceDeliveryStripe($id = null)
    {
        if ($id == null) {
            $id = session()->get('distance_delivery');
        }
        if ($id) {
            $delivery = DistanceDelivery::find($id);
            if ($delivery == null) {
                return redirect()->route('generalUsers.delivery.track')->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->route('generalUsers.delivery.track')->with('error', 'Delivery not found');
            }
        }
        return view('generalUsers.delivery.payment.distance_delivery', compact('delivery'));
    }

    public function distanceDeliveryStripePost(Request $request)
    {
        $id = $request->id;
        if ($id == null) {
            $id = session()->get('distance_delivery');
        }
        if ($id) {
            $delivery = DistanceDelivery::find($id);
            if ($delivery == null) {
                return redirect()->route('generalUsers.delivery.track')->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->route('generalUsers.delivery.track')->with('error', 'Delivery not found');
            }
        }
        try {
            $amount = $delivery->total_price;
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create Stripe charge
            $charge = Charge::create([
                "amount" => $amount * 100, // Convert to cents
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Distance Delivery Fee",
                "metadata" => [
                    "delivery_id" => $id,
                    "user_id" => auth()->id()
                ]
            ]);

            // If charge is successful, update the database
            if ($charge->status === 'succeeded') {
                $delivery->update([
                    'status' => 1, // Payment completed
                    'payment_details' => json_encode($charge), // Store response details
                    'payment_method' => 'STRIPE'
                ]);

                return redirect()->route('user.delivery.track')->with('success', 'Payment successful! Delivery created.');
            } else {
                $delivery->update([
                    'payment_details' => json_encode($charge),
                    'payment_method' => 'STRIPE'
                ]);
            }

            return redirect()->back()->with('error', 'Payment failed. Please try again.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
