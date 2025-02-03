<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use App\Models\Driver;
use App\Models\Notification;
use App\Models\VicinityDelivery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeliveryController extends Controller
{
    function distanceDelivery()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $driverServices = json_decode($driver->services);
        $services = [];
        foreach ($driverServices as $service) {
            $services[] = $service;
        }
        if (!in_array('distance-delivery', $services)) {
            return redirect()->route('driver.dashboard')->with('error', 'You do not have permission to access this page');
        }
        $activeDeliveries = DistanceDelivery::where('status', 1)->where('accepted', 0)->latest()->get();

        return view('drivers.delivery.distance.distance', compact('activeDeliveries'));
    }

    function vicinityDelivery()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $driverServices = json_decode($driver->services);
        $services = [];
        foreach ($driverServices as $service) {
            $services[] = $service;
        }
        if (!in_array('vicinity-delivery', $services)) {
            return redirect()->route('driver.dashboard')->with('error', 'You do not have permission to access this page');
        }
        $activeDeliveries = VicinityDelivery::where('status', 1)->where('accepted', 0)->latest()->get();

        return view('drivers.delivery.vicinity.vicinity', compact('activeDeliveries'));
    }

    function yourDelivery()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $driverServices = json_decode($driver->services);
        $services = [];
        foreach ($driverServices as $service) {
            $services[] = $service;
        }
        $distance = false;
        $vicinity = false;
        if (in_array('distance-delivery', $services)) {
            $distance = true;
        }
        if (in_array('vicinity-delivery', $services)) {
            $vicinity = true;
        }

        return view('drivers.delivery.my_deliveries', compact('distance', 'vicinity'));
    }
    function yourDistanceDelivery()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $driverServices = json_decode($driver->services);
        $services = [];
        foreach ($driverServices as $service) {
            $services[] = $service;
        }
        if (!in_array('distance-delivery', $services)) {
            return redirect()->route('driver.dashboard')->with('error', 'You do not have permission to access this page');
        }
        $yourDeliveries = DistanceDelivery::where('driver_id', Auth::id())->get();

        return view('drivers.delivery.distance.my_distance_deliveries', compact('yourDeliveries'));
    }
    function yourVicinityDelivery()
    {
        $driver = Driver::where('user_id', Auth::id())->first();
        $driverServices = json_decode($driver->services);
        $services = [];
        foreach ($driverServices as $service) {
            $services[] = $service;
        }
        if (!in_array('vicinity-delivery', $services)) {
            return redirect()->route('driver.dashboard')->with('error', 'You do not have permission to access this page');
        }
        $yourDeliveries = VicinityDelivery::where('driver_id', Auth::id())->get();

        return view('drivers.delivery.vicinity.my_distance_deliveries', compact('yourDeliveries'));
    }

    function distaneDeliveryAccept(Request $request)
    {
        try {
            $request->validate([
                'delivery_id' => 'required|exists:distance_deliveries,id',
            ]);

            $delivery = DistanceDelivery::findOrFail($request->delivery_id);
            $delivery->accepted = 1;
            $delivery->driver_id = Auth::id();
            $delivery->save();

            return redirect()->route('driver.delivery.distance')->with('success', 'Delivery accepted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function distaneDeliveryStatus(Request $request)
    {
        $request->validate([
            'delivery_id' => 'required|exists:distance_deliveries,id',
            'status' => 'required|in:0,1,2'
        ]);

        $delivery = DistanceDelivery::find($request->delivery_id);
        $delivery->status = $request->status;
        $delivery->save();

        Notification::create([
            'user_id' => $delivery->user_id,
            'type' => 'Distance Delivery',
            'title' => 'Delivery Accepted',
            'message' => 'Your delivery has been accepted',
            'status' => 1
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    }

    function vicinityDeliveryAccept(Request $request)
    {
        try {
            $request->validate([
                'delivery_id' => 'required|exists:vicinity_deliveries,id',
            ]);

            $delivery = VicinityDelivery::findOrFail($request->delivery_id);
            $delivery->accepted = 1;
            $delivery->driver_id = Auth::id();
            $delivery->save();

            return redirect()->route('driver.delivery.vicinity')->with('success', 'Delivery accepted successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function vicinityDeliveryStatus(Request $request)
    {
        $request->validate([
            'delivery_id' => 'required|exists:vicinity_deliveries,id',
            'status' => 'required|in:0,1,2'
        ]);

        $delivery = VicinityDelivery::find($request->delivery_id);
        $delivery->status = $request->status;
        $delivery->save();

        Notification::create([
            'user_id' => $delivery->user_id,
            'type' => 'Vicinity Delivery',
            'title' => 'Delivery Accepted',
            'message' => 'Your delivery has been accepted',
            'status' => 1
        ]);

        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    }
}
