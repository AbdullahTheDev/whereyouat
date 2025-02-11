<?php

namespace App\Http\Controllers\LocalDriver;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function availableDeliveries(){
        $deliveries = DistanceDelivery::where('relay_id', '!=', null)->get();

        return view('localdrivers.delivery.available.index', compact('deliveries'));
    }
}
