<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        $driver = Driver::where('user_id', $user->id)->first();
        return view('users.profile.edit', compact('user', 'driver'));
    }

    function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:20',
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

            $user = User::findOrFail(Auth::id());
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $driver = Driver::where('user_id', $user->id)->first();

            if ($request->hasFile('license_photo_front')) {
                $licenseFrontPath = 'drivers/' . time() . '_front.' . $request->file('license_photo_front')->extension();
                $request->file('license_photo_front')->move(public_path('drivers'), $licenseFrontPath);
                $driver->license_photo_front = $licenseFrontPath;
            }

            if ($request->hasFile('license_photo_back')) {
                $licenseBackPath = 'drivers/' . time() . '_back.' . $request->file('license_photo_back')->extension();
                $request->file('license_photo_back')->move(public_path('drivers'), $licenseBackPath);
                $driver->license_photo_back = $licenseBackPath;
            }

            if ($request->hasFile('vehicle_photo')) {
                $vehiclePhotoPath = 'vehicles/' . time() . '_vehicle.' . $request->file('vehicle_photo')->extension();
                $request->file('vehicle_photo')->move(public_path('vehicles'), $vehiclePhotoPath);
                $driver->vehicle_photo = $vehiclePhotoPath;
            }

            $driver->vehicle_make = $request->vehicle_make;
            $driver->vehicle_model = $request->vehicle_model;
            $driver->vehicle_year = $request->vehicle_year;
            $driver->vehicle_plate = $request->vehicle_plate;
            $driver->vehicle_color = $request->vehicle_color;
            $driver->vehicle_seats = $request->vehicle_seats;
            $driver->services = json_encode($request->services);
            $driver->packages = json_encode($request->packages);
            $driver->local_delivery_city = $request->local_delivery_city;

            $driver->save();

            // Check if the current password is provided and valid
            if ($request->filled('current_password') && Hash::check($request->current_password, $user->password)) {
                if ($request->filled('new_password')) {
                    $user->update([
                        'password' => Hash::make($request->new_password)
                    ]);
                } else {
                    return back()->with('error', 'New password is required.');
                }
            } elseif ($request->filled('current_password')) {
                return back()->with('error', 'Current password is incorrect.');
            }

            return back()->with('success', 'Profile updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
