<?php

namespace App\Http\Controllers\Businesses;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        $business = Business::where('user_id', $user->id)->first();
        $manager = json_decode($business->co_manager_details, true);
        return view('businesses.profile.edit', compact('user', 'business', 'manager'));
    }

    function update(Request $request)
    {
        try {
            $request->validate([
                'trade_name' => 'required|string|max:255',
                'responsible_address' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:20',
                'date_of_birth' => 'required|date',
                'business_name' => 'required|string|max:255',
                'business_phone' => 'required|string|max:20',
                'business_email' => 'required|string|email|max:255',
                'business_number' => 'required|string',

                'manager_name' => 'required|string|max:255',
                'manager_phone' => 'required|string|max:20',
                'manager_email' => 'required|string|email|max:255',
                'manager_date_of_birth' => 'required|date',
                'availability_days' => 'required|array',
                'time_from' => 'required|date_format:H:i',
                'time_to' => 'required|date_format:H:i',
                'ownership_proof' => 'nullable|image|max:5048',
                'profile_photo' => 'nullable|image|max:5048',
            ]);

            $user = User::findOrFail(Auth::id());
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
            ]);

            $business = Business::where('user_id', $user->id)->first();
            $business->update([
                'trade_name' => $request->trade_name,
                'responsible_address' => $request->responsible_address,
                'business_name' => $request->business_name,
                'business_phone' => $request->business_phone,
                'business_email' => $request->business_email,
                'business_number' => $request->business_number,
                'co_manager_details' => json_encode([
                    'name' => $request->manager_name,
                    'email' => $request->manager_email,
                    'phone' => $request->manager_phone,
                    'date_of_birth' => $request->manager_date_of_birth,
                ]),
                'availability_days' => json_encode($request->availability_days),
                'time_from' => $request->time_from,
                'time_to' => $request->time_to,
            ]);

            if ($request->hasFile('ownership_proof')) {
                $licenseFrontPath = 'businesses/' . time() . '_front.' . $request->file('ownership_proof')->extension();
                $request->file('ownership_proof')->move(public_path('businesses'), $licenseFrontPath);
                $business->ownership_proof = $licenseFrontPath;
            }

            if ($request->hasFile('profile_photo')) {
                $licenseBackPath = 'businesses/' . time() . '_back.' . $request->file('profile_photo')->extension();
                $request->file('profile_photo')->move(public_path('businesses'), $licenseBackPath);
                $business->profile_photo = $licenseBackPath;
            }

            $business->save();

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
