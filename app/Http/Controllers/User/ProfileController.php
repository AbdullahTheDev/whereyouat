<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    function edit()
    {
        $user = Auth::user();
        $userProfile = UserProfile::where('user_id', $user->id)->first();
        return view('users.profile.edit', compact('user', 'userProfile'));
    }

    function update(Request $request)
    {
        //
    }

    function destroy(Request $request)
    {
        //
    }
}
