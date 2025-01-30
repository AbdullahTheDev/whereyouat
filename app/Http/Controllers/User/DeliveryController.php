<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use App\Models\PackageDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    function distanceDelivery() {
        return view('generalUsers.delivery.distance');
    }

    function vicinityDelivery() {
        return view('generalUsers.delivery.vicinity');
    }

    function trackDelivery() {
        $deliveries = DistanceDelivery::where('user_id', Auth::id())->get();

        return view('generalUsers.delivery.track.index', compact('deliveries'));
    }


    function distanceDeliveryStore(Request $request) {
        try{
            $request->validate([
                'departure_city' => 'required|string|max:255',
                'arrival_city' => 'required|string|max:255',
                'transaction_date' => 'required|date',
                'delivery_mode' => 'required|string',
                'total_price' => 'required',
                'package_type' => 'required',
                'package_quantity' => 'required',
            ]);

            $delivery = DistanceDelivery::create([
                'user_id' => Auth::id(),
                'departure_city' => $request->departure_city,
                'arrival_city' => $request->arrival_city,
                'transaction_date' => $request->transaction_date,
                'delivery_mode' => $request->delivery_mode,
                'total_price' => $request->total_price,
            ]);

            foreach ($request->package_type as $key => $value) {
                PackageDetail::create([
                    'delivery_id' => $delivery->id,
                    'package_type' => $value,
                    'qty' => $request->package_quantity[$key],
                ]);
            }

            session()->put('distance_delivery', $delivery->id);

            return redirect()->route('user.delivery.distance.stripe', $delivery->id);

        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }
}
