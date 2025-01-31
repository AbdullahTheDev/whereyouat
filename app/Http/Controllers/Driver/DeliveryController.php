<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use App\Models\Driver;
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
        if(!in_array('distance-delivery', $services)){
            return redirect()->route('driver.dashboard')->with('error', 'You do not have permission to access this page');
        }
        $activeDeliveries = DistanceDelivery::where('status', 1)->latest()->get();
        
        // return $activeDeliveries[0]->packageDetails;
        return view('drivers.delivery.distance_delivery', compact('activeDeliveries'));
    }

    function vicinityDelivery()
    {
        return view('drivers.delivery.vicinity_delivery');
    }
}
