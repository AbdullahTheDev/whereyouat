<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{
    function index() {
        $yourDeliveries = DistanceDelivery::where('driver_id', Auth::id())->where('status', 2)->get();

        $distanceDeliveriesEarning = $yourDeliveries->sum('total_price');

        $vicinityDeliveries = DistanceDelivery::where('driver_id', Auth::id())->where('status', 2)->get();

        $vicinityDeliveriesEarning = $vicinityDeliveries->sum('total_price');

        return view('drivers.index', compact('distanceDeliveriesEarning', 'vicinityDeliveriesEarning'));
    }
}
