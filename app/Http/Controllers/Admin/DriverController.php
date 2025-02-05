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

    function importDrivers(){
        return view('admin.drivers.add.import');
    }

    function importDriversPost(Request $request){
        $request->validate([
            'file' => 'required|mimes:xls,xlsx,csv',
        ]);

        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '.' . $extension;
        $file->move('uploads/drivers/', $fileName);

        return redirect()->back()->with('success', 'Drivers imported successfully');
    }
}
