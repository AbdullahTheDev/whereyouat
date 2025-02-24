<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\DistanceDelivery;
use App\Models\Driver;
use App\Models\LocalDriver;
use App\Models\PackageDetail;
use App\Models\PartnerHome;
use App\Models\User;
use App\Models\VicinityDelivery;
use App\Models\VicinityPackageDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    function distanceDelivery()
    {
        return view('users.delivery.distance');
    }

    function vicinityDelivery()
    {
        return view('users.delivery.vicinity');
    }

    function trackDelivery()
    {
        return view('users.delivery.track.index');
    }
    function distanceTrackDelivery()
    {
        $deliveries = DistanceDelivery::where('delivery_mode', 'direct')->latest()->get();
        $deliveriesPartners = DistanceDelivery::where('delivery_mode', 'partner')->latest()->get();

        return view('users.delivery.track.distance.index', compact('deliveries', 'deliveriesPartners'));
    }

    function vicinityTrackDelivery()
    {
        $deliveries = VicinityDelivery::where('user_id', Auth::id())->latest()->get();

        return view('users.delivery.track.vicinity.index', compact('deliveries'));
    }


    function distanceDeliveryStore(Request $request)
    {
        try {
            $request->validate([
                'departure_city' => 'required|string|max:255',
                'arrival_city' => 'required|string|max:255',
                'transaction_date' => 'required|date',
                'delivery_mode' => 'required|string|in:partner,direct',
                'total_price' => 'required',
                'package_type' => 'required',
                'package_quantity' => 'required',
                'package_description' => 'required',
            ]);

            $packageTypes = $request->input('package_type');
            $packageQuantities = $request->input('package_quantity');

            // Recheck Mini Carton total quantity does not exceed 15kg
            $miniCartonTotal = 0;
            foreach ($packageTypes as $index => $type) {
                if ($type === 'mini_carton') {
                    $miniCartonTotal += $packageQuantities[$index];
                }
            }

            if ($miniCartonTotal > 15) {
                return redirect()->back()->with('error', 'The total weight of Mini Carton packages cannot exceed 15kg.');
            }

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
                    'package_type' => str_replace('_', '-', $value),
                    'qty' => $request->package_quantity[$key],
                    'description' => $request->package_description[$key],
                ]);
            }

            session()->put('distance_delivery', $delivery->id);

            if ($request->delivery_mode == 'partner') {
                return redirect()->route('user.delivery.distance.partner', $delivery->id);
            }

            return redirect()->route('user.delivery.distance.stripe', $delivery->id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function distanceDeliveryPartner($id)
    {
        try {
            $delivery = DistanceDelivery::findOrFail($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $relayArrivalPartners = PartnerHome::where('city', 'LIKE', '%' . $delivery->arrival_city . '%')
                ->get();

            $relayArrivalBusinesses = Business::where('city', 'LIKE', '%' . $delivery->arrival_city . '%')
                ->get();

            $relays = $relayArrivalPartners->merge($relayArrivalBusinesses);

            $relayDeparturePartners = PartnerHome::where('city', 'LIKE', '%' . $delivery->departure_city . '%')
                ->get();

            $relayDepartureBusinesses = Business::where('city', 'LIKE', '%' . $delivery->departure_city . '%')
                ->get();

            $departureRelays = $relayDeparturePartners->merge($relayDepartureBusinesses);

            // return $relayDeparturePartners;
            return view('users.delivery.select_relay.relay', compact('relays', 'delivery', 'departureRelays'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function distanceDeliveryPartnerPost(Request $request)
    {
        try {
            $request->validate([
                'delivery_id' => 'required|integer',
                'relay_id' => 'required|integer',
            ]);

            $delivery = DistanceDelivery::findOrFail($request->delivery_id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }

            $relay = PartnerHome::findOrFail($request->relay_id);
            if (!$relay) {
                return redirect()->back()->with('error', 'Relay not found');
            }

            $delivery->update([
                'relay_id' => $relay->user_id,
                'relay_type' => $relay->user->role,
            ]);

            return redirect()->route('user.delivery.distance.stripe', $delivery->id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function vicinityDeliveryStore(Request $request)
    {
        try {
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
                VicinityPackageDetail::create([
                    'delivery_id' => $delivery->id,
                    'package_type' => str_replace('_', '-', $value),
                    'qty' => $request->package_quantity[$key],
                    'description' => $request->package_description[$key],
                ]);
            }

            session()->put('vicinity_delivery', $delivery->id);

            return redirect()->route('user.delivery.vicinity.stripe', $delivery->id);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    function distanceDriver($id)
    {
        try {
            $delivery = DistanceDelivery::find($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $user = User::find($delivery->driver_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = Driver::where('user_id', $user->id)->first();
            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $localDriver = 0;
            return view('users.delivery.drivers.driver_info', compact('driver', 'localDriver'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function distanceLocalDriver($id)
    {
        try {
            $delivery = DistanceDelivery::find($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $user = User::find($delivery->driver_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = LocalDriver::where('user_id', $user->id)->first();
            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $localDriver = 1;
            return view('users.delivery.drivers.driver_info', compact('driver', 'localDriver'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function vicinityDriver($id)
    {
        try {
            $delivery = VicinityDelivery::findOrFail($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $user = User::findOrFail($delivery->driver_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = Driver::where('user_id', $user->id)->first();
            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            return view('users.delivery.drivers.driver_info', compact('driver'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function distancePartner($id)
    {
        try {
            $delivery = DistanceDelivery::findOrFail($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            if ($delivery->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'You do not have permission to access this delivery');
            }
            $user = User::findOrFail($delivery->driver_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            if ($user->role == 'partner_home') {
                $relay = PartnerHome::where('user_id', $user->id)->first();
            } else {
                $relay = Business::where('user_id', $user->id)->first();
            }
            if (!$relay) {
                return redirect()->back()->with('error', 'Partner not found');
            }
            return view('users.delivery.partners.partner_info', compact('relay'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
