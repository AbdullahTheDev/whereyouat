<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\BusinessesImport;
use App\Imports\DriversImport;
use App\Imports\LocalDriversImport;
use App\Imports\PartnersImport;
use App\Models\Business;
use App\Models\Driver;
use App\Models\LocalDriver;
use App\Models\PartnerHome;
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


    function allLocalDrivers()
    {
        $drivers = LocalDriver::all();
        return view('admin.local_drivers.all_drivers', compact('drivers'));
    }

    function importLocalDrivers()
    {
        return view('admin.local_drivers.import.import');
    }

    function importLocalDriversPost(Request $request)
    {
        // return  $request->file('file')->extension();
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx,csv',
            ]);

            Excel::import(new LocalDriversImport, $request->file('file'));

            return redirect()->back()->with('success', 'Drivers imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    function allBusinesses()
    {
        $businesses = Business::all();
        return view('admin.businesses.all_businesses', compact('businesses'));
    }

    function importBusinesses()
    {
        return view('admin.businesses.import.import');
    }

    function importBusinessesPost(Request $request)
    {
        // return  $request->file('file')->extension();
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx,csv',
            ]);

            Excel::import(new BusinessesImport, $request->file('file'));

            return redirect()->back()->with('success', 'Businesses imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    function allPartners()
    {
        $partners = PartnerHome::all();
        return view('admin.partners.all_partners', compact('partners'));
    }

    function importPartners()
    {
        return view('admin.partners.import.import');
    }

    function importPartnersPost(Request $request)
    {
        // return  $request->file('file')->extension();
        try {
            $request->validate([
                'file' => 'required|mimes:xls,xlsx,csv',
            ]);

            Excel::import(new PartnersImport, $request->file('file'));

            return redirect()->back()->with('success', 'Partners imported successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
