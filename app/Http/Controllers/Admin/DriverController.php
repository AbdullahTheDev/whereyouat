<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'terms_approved' => $request->terms_approved,
        ]);

        $this->registerDriver($request, $user);

        return redirect()->back()->with('success', 'Drivers imported successfully');
    }
    private function registerDriver(Request $request, User $user)
    {
        $request->validate([
            'license_photo_front' => 'required|image|max:2048',
            'license_photo_back' => 'required|image|max:2048',
            'vehicle_make' => 'required|string|max:255',
            'vehicle_model' => 'required|string|max:255',
            'vehicle_year' => 'required|integer',
            'vehicle_plate' => 'required|string|max:255',
            'vehicle_color' => 'required|string|max:255',
            'vehicle_seats' => 'required|integer',
            'vehicle_photo' => 'required|image|max:2048',
            'services' => 'required|array',
            'packages' => 'required|array',
            'local_delivery_city' => 'nullable|string|max:255',
        ]);

        $licenseFrontPath = 'drivers/' . time() . '_front.' . $request->file('license_photo_front')->extension();
        $licenseBackPath = 'drivers/' . time() . '_back.' . $request->file('license_photo_back')->extension();
        $vehiclePhotoPath = 'vehicles/' . time() . '_vehicle.' . $request->file('vehicle_photo')->extension();

        $request->file('license_photo_front')->move(public_path('drivers'), $licenseFrontPath);
        $request->file('license_photo_back')->move(public_path('drivers'), $licenseBackPath);
        $request->file('vehicle_photo')->move(public_path('vehicles'), $vehiclePhotoPath);

        $driver = new Driver([
            'user_id' => $user->id,
            'license_photo_front' => $licenseFrontPath,
            'license_photo_back' => $licenseBackPath,
            'vehicle_make' => $request->vehicle_make,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_year' => $request->vehicle_year,
            'vehicle_plate' => $request->vehicle_plate,
            'vehicle_color' => $request->vehicle_color,
            'vehicle_seats' => $request->vehicle_seats,
            'vehicle_photo' => $vehiclePhotoPath,
            'services' => json_encode($request->services),
            'packages' => json_encode($request->packages),
            'local_delivery_city' => $request->local_delivery_city,
        ]);

        $driver->save();
    }
}
