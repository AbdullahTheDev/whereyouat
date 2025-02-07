<?php

namespace App\Http\Controllers\PartnerHome;

use App\Http\Controllers\Controller;
use App\Models\PartnerHome;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        $partner_home = PartnerHome::where('user_id', $user->id)->first();
        return view('partners.profile.edit', compact('user', 'partner_home'));
    }

    function update(Request $request)
    {
        try {
            $request->validate([
                'home_name' => 'required|string|max:255',
                'home_address' => 'required|string',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:20',
                'date_of_birth' => 'required|date',
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

            $partner_home = PartnerHome::where('user_id', $user->id)->first();
            $partner_home->update([
                'home_name' => $request->home_name,
                'home_address' => $request->home_address,
                'manager' => json_encode([
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
                $licenseFrontPath = 'partner_homes/' . time() . '_front.' . $request->file('ownership_proof')->extension();
                $request->file('ownership_proof')->move(public_path('partner_homes'), $licenseFrontPath);
                $partner_home->ownership_proof = $licenseFrontPath;
            }

            if ($request->hasFile('profile_photo')) {
                $licenseBackPath = 'partner_homes/' . time() . '_back.' . $request->file('profile_photo')->extension();
                $request->file('profile_photo')->move(public_path('partner_homes'), $licenseBackPath);
                $partner_home->profile_photo = $licenseBackPath;
            }

            $partner_home->save();

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
