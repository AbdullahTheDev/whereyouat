<?php

namespace App\Http\Controllers\LocalDriver;

use App\Http\Controllers\Controller;
use App\Models\LocalDelivery;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function index()
    {
        $deliveriesEarning = 12400;
        return view('localdrivers.index', compact('deliveriesEarning'));
    }
}
