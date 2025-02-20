<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DistanceDelivery;
use App\Models\VicinityDelivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    function index(){
        return view('admin.delivery.index');
    }
    function distanceDeliveryDirect(){
        $deliveries = DistanceDelivery::where('type', 'direct')->get();
        return view('admin.deliveries.distance.direct.index', compact('deliveries'));
    }
    function distanceDeliveryPartner(){
        $deliveries = DistanceDelivery::where('type', 'partner')->get();
        return view('admin.deliveries.distance.partner.index', compact('deliveries'));
    }
    function vicinityDelivery(){
        $deliveries = VicinityDelivery::all();
        return view('admin.deliveries.vicinity.direct.index', compact('deliveries'));
    }
}
