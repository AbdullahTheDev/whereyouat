<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    function allDrivers(){
        $drivers = Driver::all();
        return view('admin.drivers.all_drivers', compact('drivers'));
    }
}
