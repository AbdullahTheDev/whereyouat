<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\DriversImport;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DriverController extends Controller
{
    function allDrivers()
    {
        $drivers = Driver::all();
        return view('admin.drivers.all_drivers', compact('drivers'));
    }

    function importDrivers()
    {
        return view('admin.drivers.import.import');
    }

    function importDriversPost(Request $request)
    {
        // return  $request->file('file')->extension();
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx,csv',
            ]);

            Excel::import(new DriversImport, $request->file('file'));

            return redirect()->back()->with('success', 'Drivers imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
