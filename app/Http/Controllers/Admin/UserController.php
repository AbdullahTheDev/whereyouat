<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function allUsers()
    {
        $users = User::all();
        return view('admin.users.all_users', compact('users'));
    }
}
