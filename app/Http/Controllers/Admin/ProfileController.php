<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        return view('admin.profile.edit', compact('user', 'userProfile'));
    }

    function update(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'date_of_birth' => 'required|date',
                'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $user = User::findOrFail(Auth::id());
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            $userProfile = UserProfile::where('user_id', $user->id)->firstOrCreate([
                'user_id' => $user->id
            ]);

            // Handle Profile Photo Upload
            if ($request->hasFile('profile_photo')) {
                $file = $request->file('profile_photo');
                $filename = 'profile_' . $user->id . '.' . $file->getClientOriginalExtension();

                // Move file to users_profile directory
                $file->move(public_path('users_profile'), $filename);

                // Delete old profile photo if exists
                if ($userProfile->profile_photo && file_exists(public_path('users_profile/' . $userProfile->profile_photo))) {
                    unlink(public_path('users_profile/' . $userProfile->profile_photo));
                }

                // Update profile photo in database
                $userProfile->profile_photo = $filename;
            }

            $userProfile->update([
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
            ]);

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
