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

        $idPhotoPath = 'local_delivery/' . time() . '_id.' . $request->file('id_photo')->extension();
        $proofPath = 'local_delivery/' . time() . '_proof.' . $request->file('proof_of_domicile')->extension();

        $request->file('id_photo')->move(public_path('local_delivery'), $idPhotoPath);
        $request->file('proof_of_domicile')->move(public_path('local_delivery'), $proofPath);

        LocalDelivery::create([
            'user_id' => $user->id,
            'id_photo' => $idPhotoPath,
            'proof_of_domicile' => $proofPath,
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

        $ownershipProofPath = 'businesses/' . time() . '_proof.' . $request->file('ownership_proof')->extension();
        $request->file('ownership_proof')->move(public_path('businesses'), $ownershipProofPath);

        Business::create([
            'user_id' => $user->id,
            'trade_name' => $request->trade_name,
            'business_address' => $request->business_address,
            'business_number' => $request->business_number,
            'co_manager_details' => json_encode($request->co_manager_details),
            'ownership_proof' => $ownershipProofPath,
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

        $ownershipProofPath = 'partner_homes/' . time() . '_proof.' . $request->file('ownership_proof')->extension();
        $request->file('ownership_proof')->move(public_path('partner_homes'), $ownershipProofPath);

        PartnerHome::create([
            'user_id' => $user->id,
            'home_name' => $request->home_name,
            'home_address' => $request->home_address,
            'managers' => json_encode($request->managers),
            'availability' => json_encode($request->availability),
            'ownership_proof' => $ownershipProofPath,
        ]);
    }
}
