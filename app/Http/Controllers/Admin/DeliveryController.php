<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\DistanceDelivery;
use App\Models\Driver;
use App\Models\PartnerHome;
use App\Models\User;
use App\Models\VicinityDelivery;
use Exception;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function index(){
        return view('admin.delivery.index');
    }
    function distanceDeliveryDirect(){
        $deliveries = DistanceDelivery::where('delivery_mode', 'direct')->get();
        return view('admin.deliveries.distance.direct.index', compact('deliveries'));
    }
    function distanceDeliveryPartner(){
        $deliveries = DistanceDelivery::where('delivery_mode', 'partner')->get();
        return view('admin.deliveries.distance.partner.index', compact('deliveries'));
    }
    function vicinityDelivery(){
        $deliveries = VicinityDelivery::all();
        return view('admin.deliveries.vicinity.index', compact('deliveries'));
    }


    function distanceDriver($id)
    {
        try {
            $delivery = DistanceDelivery::findOrFail($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            $user = User::findOrFail($delivery->driver_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = Driver::where('user_id', $user->id)->first();
            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            return view('admin.deliveries.driver.driver_info', compact('driver'));
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
            $user = User::findOrFail($delivery->driver_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            $driver = Driver::where('user_id', $user->id)->first();
            if (!$driver) {
                return redirect()->back()->with('error', 'Driver not found');
            }
            return view('admin.deliveries.driver.driver_info', compact('driver'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    function distancePartner($id)
    {
        try {
            $delivery = DistanceDelivery::find($id);
            if (!$delivery) {
                return redirect()->back()->with('error', 'Delivery not found');
            }
            
            $user = User::find($delivery->relay_id);
            if (!$user) {
                return redirect()->back()->with('error', 'Partner not found');
            }
            if ($user->role == 'partner_home') {
                $relay = PartnerHome::where('user_id', $user->id)->first();
            } else {
                $relay = Business::where('user_id', $user->id)->first();
            }
            if (!$relay) {
                return redirect()->back()->with('error', 'Partner not found');
            }
            return view('admin.deliveries.partners.partner_info', compact('relay'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    function assignDriverDistance(Request $request)
    {
        try {
            $request->validate([
                'delivery_id' => 'required|exists:distance_deliveries,id',
                'driver_id' => 'required|exists:users,id',
            ]);

            $delivery = DistanceDelivery::findOrFail($request->delivery_id);
            $delivery->accepted = 1;
            $delivery->driver_id = $request->driver_id;
            $delivery->save();

            return redirect()->back()->with('success', 'Delivery assigned successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
