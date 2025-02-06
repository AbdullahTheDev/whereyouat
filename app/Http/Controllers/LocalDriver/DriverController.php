<?php

namespace App\Http\Controllers\LocalDriver;

use App\Http\Controllers\Controller;
use App\Models\LocalDelivery;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function index()
    {
        $deliveriesEarning = LocalDelivery::where('status', 'accepted')->sum('delivery_fee');
        return view('localdrivers.index');
    }
}
