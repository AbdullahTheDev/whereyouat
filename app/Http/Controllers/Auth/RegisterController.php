<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\Driver;
use App\Models\LocalDelivery;
use App\Models\Business;
use App\Models\PartnerHome;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        // Validate common user fields
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
            'role' => ['required', Rule::in(['driver', 'local_delivery', 'business', 'partner_home', 'general_user'])],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Store additional information based on role
        switch ($request->role) {
            case 'driver':
                $this->registerDriver($request, $user);
                break;
            case 'local_delivery':
                $this->registerLocalDelivery($request, $user);
                break;
            case 'business':
                $this->registerBusiness($request, $user);
                break;
            case 'partner_home':
                $this->registerPartnerHome($request, $user);
                break;
        }

        // Log in the user automatically after registration
        auth()->login($user);

        return redirect()->route('dashboard')->with('success', 'Registration successful.');
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

        $driver = new Driver([
            'user_id' => $user->id,
            'license_photo_front' => $request->file('license_photo_front')->store('drivers'),
            'license_photo_back' => $request->file('license_photo_back')->store('drivers'),
            'vehicle_make' => $request->vehicle_make,
            'vehicle_model' => $request->vehicle_model,
            'vehicle_year' => $request->vehicle_year,
            'vehicle_plate' => $request->vehicle_plate,
            'vehicle_color' => $request->vehicle_color,
            'vehicle_seats' => $request->vehicle_seats,
            'vehicle_photo' => $request->file('vehicle_photo')->store('vehicles'),
            'services' => json_encode($request->services),
            'packages' => json_encode($request->packages),
            'local_delivery_city' => $request->local_delivery_city,
        ]);

        $driver->save();
    }

    private function registerLocalDelivery(Request $request, User $user)
    {
        $request->validate([
            'id_photo' => 'required|image|max:2048',
            'proof_of_domicile' => 'required|image|max:2048',
            'means_of_transport' => 'required|string|max:255',
            'transport_details' => 'required|array',
            'availability_days' => 'required|array',
            'availability_hours' => 'required|array',
        ]);

        LocalDelivery::create([
            'user_id' => $user->id,
            'id_photo' => $request->file('id_photo')->store('local_delivery'),
            'proof_of_domicile' => $request->file('proof_of_domicile')->store('local_delivery'),
            'means_of_transport' => $request->means_of_transport,
            'transport_details' => json_encode($request->transport_details),
            'availability_days' => json_encode($request->availability_days),
            'availability_hours' => json_encode($request->availability_hours),
        ]);
    }

    private function registerBusiness(Request $request, User $user)
    {
        $request->validate([
            'trade_name' => 'required|string|max:255',
            'business_address' => 'required|string|max:255',
            'business_number' => 'required|string|max:255',
            'co_manager_details' => 'required|array',
            'ownership_proof' => 'required|image|max:2048',
            'availability' => 'required|array',
        ]);

        Business::create([
            'user_id' => $user->id,
            'trade_name' => $request->trade_name,
            'business_address' => $request->business_address,
            'business_number' => $request->business_number,
            'co_manager_details' => json_encode($request->co_manager_details),
            'ownership_proof' => $request->file('ownership_proof')->store('businesses'),
            'availability' => json_encode($request->availability),
        ]);
    }

    private function registerPartnerHome(Request $request, User $user)
    {
        $request->validate([
            'home_name' => 'required|string|max:255',
            'home_address' => 'required|string|max:255',
            'managers' => 'required|array',
            'availability' => 'required|array',
            'ownership_proof' => 'required|image|max:2048',
        ]);

        PartnerHome::create([
            'user_id' => $user->id,
            'home_name' => $request->home_name,
            'home_address' => $request->home_address,
            'managers' => json_encode($request->managers),
            'availability' => json_encode($request->availability),
            'ownership_proof' => $request->file('ownership_proof')->store('partner_homes'),
        ]);
    }
}
