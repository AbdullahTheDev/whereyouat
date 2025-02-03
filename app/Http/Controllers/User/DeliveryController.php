<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use App\Models\Driver;
use App\Models\PackageDetail;
use App\Models\User;
use App\Models\VicinityDelivery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    function distanceDelivery() {
        return view('users.delivery.distance');
    }

    function vicinityDelivery() {
        return view('users.delivery.vicinity');
    }

    function trackDelivery() {
        return view('users.delivery.track.index');
    }
    function distanceTrackDelivery() {
        $deliveries = DistanceDelivery::where('user_id', Auth::id())->latest()->get();

        return view('users.delivery.track.distance.index', compact('deliveries'));
    }

    function vicinityTrackDelivery() {
        $deliveries = VicinityDelivery::where('user_id', Auth::id())->latest()->get();

        return view('users.delivery.track.vicinity.index', compact('deliveries'));
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
                'package_description' => 'required',
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
                    'description' => $request->package_description[$key],
                ]);
            }

            session()->put('distance_delivery', $delivery->id);

            return redirect()->route('user.delivery.distance.stripe', $delivery->id);

        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }


    function vicinityDeliveryStore(Request $request) {
        try{
            $request->validate([
                'departure_address' => 'required|string|max:255',
                'arrival_address' => 'required|string|max:255',
                'transaction_date' => 'required|date',
                'total_price' => 'required',
                'package_type' => 'required',
                'package_quantity' => 'required',
                'package_description' => 'required',
            ]);

            $delivery = VicinityDelivery::create([
                'user_id' => Auth::id(),
                'departure_address' => $request->departure_address,
                'arrival_address' => $request->arrival_address,
                'transaction_date' => $request->transaction_date,
                'total_price' => $request->total_price,
            ]);

            foreach ($request->package_type as $key => $value) {
                PackageDetail::create([
                    'delivery_id' => $delivery->id,
                    'package_type' => $value,
                    'qty' => $request->package_quantity[$key],
                    'description' => $request->package_description[$key],
                ]);
            }

            session()->put('vicinity_delivery', $delivery->id);

            return redirect()->route('user.delivery.vicinity.stripe', $delivery->id);

        }catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        } 
    }

    function distanceDriver($id){
        try{
            $delivery = DistanceDelivery::findOrFail($id);
            if(!$delivery){
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if($delivery->user_id != Auth::id()){
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $user = User::findOrFail($delivery->driver_id);
            if(!$user){
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = Driver::where('user_id', $user->id)->first();
            if(!$driver){
                return redirect()->back()->with('error', 'Driver not found');
            }
            return view('users.delivery.drivers.driver_info', compact('driver'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function vicinityDriver($id){
        try{
            $delivery = VicinityDelivery::findOrFail($id);
            if(!$delivery){
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if($delivery->user_id != Auth::id()){
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $user = User::findOrFail($delivery->driver_id);
            if(!$user){
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = Driver::where('user_id', $user->id)->first();
            if(!$driver){
                return redirect()->back()->with('error', 'Driver not found');
            }
            return view('users.delivery.drivers.driver_info', compact('driver'));
        }catch(Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
