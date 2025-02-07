<?php

namespace App\Http\Controllers\LocalDriver;

use App\Http\Controllers\Controller;
use App\Models\LocalDriver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        $driver = LocalDriver::where('user_id', $user->id)->first();
        $manager = json_decode($driver->co_manager_details, true);
        return view('localdrivers.profile.edit', compact('user', 'driver', 'manager'));
    }

    function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:20',
                'date_of_birth' => 'required|date',
                'photo_of_facial_id' => 'nullable|image|max:4048',
                'proof_of_domicile' => 'nullable|image|max:4048',
                'walk' => 'required|boolean',
                'availability_days' => 'required|array',
                'time_from' => 'required|date_format:H:i',
                'time_to' => 'required|date_format:H:i',
                'city' => 'required|string',
                'address' => 'required|string',
                'vehicle_make' => 'nullable|required_if:walk,false|string|max:255',
                'vehicle_model' => 'nullable|required_if:walk,false|string|max:255',
                'vehicle_year' => 'nullable|required_if:walk,false|string|max:255',
                'vehicle_plate' => 'nullable|required_if:walk,false|string|max:255',
                'vehicle_color' => 'nullable|required_if:walk,false|string|max:255',
                'mean_of_transport' => 'nullable|required_if:walk,false|string|max:255',
            ]);
    
            $user = User::findOrFail(Auth::id());
    
            // Prevent unverified email changes
            if ($user->email !== $request->email) {
                $user->email = $request->email;
                $user->email_verified_at = null;
                $user->save();
                $user->sendEmailVerificationNotification();
            }
    
            $user->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
            ]);
    
            $business = LocalDriver::where('user_id', $user->id)->first();
            if (!$business) {
                return back()->with('error', 'Local driver profile not found.');
            }
    
            $business->update([
                'mean_of_transport' => $request->mean_of_transport,
                'availability_days' => json_encode($request->availability_days),
                'vehicle_make' => $request->vehicle_make,
                'vehicle_model' => $request->vehicle_model,
                'vehicle_year' => $request->vehicle_year,
                'vehicle_plate' => $request->vehicle_plate,
                'vehicle_color' => $request->vehicle_color,
                'walk' => $request->walk,
                'city' => $request->city,
                'address' => $request->address,
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
            ]);
    
            // Handle file updates with old file deletion
            if ($request->hasFile('photo_of_facial_id')) {
                if ($business->photo_of_facial_id && file_exists(public_path($business->photo_of_facial_id))) {
                    unlink(public_path($business->photo_of_facial_id));
                }
                $photoPath = 'drivers/local/' . time() . '_proof.' . $request->file('photo_of_facial_id')->extension();
                $request->file('photo_of_facial_id')->move(public_path('drivers/local'), $photoPath);
                $business->photo_of_facial_id = $photoPath;
            }
    
            if ($request->hasFile('proof_of_domicile')) {
                if ($business->proof_of_domicile && file_exists(public_path($business->proof_of_domicile))) {
                    unlink(public_path($business->proof_of_domicile));
                }
                $proofPath = 'drivers/local/' . time() . '_domicile.' . $request->file('proof_of_domicile')->extension();
                $request->file('proof_of_domicile')->move(public_path('drivers/local'), $proofPath);
                $business->proof_of_domicile = $proofPath;
            }
    
            $business->save();
    
            // Handle password update
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
