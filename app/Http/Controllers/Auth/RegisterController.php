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
use App\Models\LocalDriver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        // return $request->all();
        // return $request->all();
        try {
            // Validate common user fields
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'phone' => 'required|string|max:20',
                'date_of_birth' => 'required|date',
                'password' => 'required|string|min:6|confirmed',
                'role' => ['required', Rule::in(['driver', 'local_driver', 'business', 'partner_home', 'user'])],
                'terms_approved' => 'required|boolean',
            ]);

            if ($request->role == 'user') {
                $request->validate([
                    'address' => 'required|string|max:255',
                ]);
            }
            DB::beginTransaction();
            // Create user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'date_of_birth' => $request->date_of_birth,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'terms_approved' => $request->terms_approved,
            ]);

            $route = '';
            // Store additional information based on role
            switch ($request->role) {
                case 'driver':
                    $this->registerDriver($request, $user);
                    $route = 'driver.dashboard';
                    break;
                case 'local_driver':
                    $this->registerLocalDriver($request, $user);
                    $route = 'local_driver.dashboard';
                    break;
                case 'business':
                    $this->registerBusiness($request, $user);
                    $route = 'businesses.dashboard';
                    break;
                case 'partner_home':
                    $this->registerPartnerHome($request, $user);
                    $route = 'partner_home.dashboard';
                    break;
                case 'user':
                    UserProfile::create([
                        'user_id' => $user->id,
                        'address' => $request->address
                    ]);
                    $route = 'user.dashboard';
                    break;
            }
            DB::commit();

            // Log in the user automatically after registration
            auth()->login($user);
            return redirect()->route($route)->with('success', 'Registration completed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Error Message
            return redirect()->back()->with('error', $e->getMessage());
        }
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

    private function registerLocalDriver(Request $request, User $user)
    {
        $request->validate([
            'photo_of_facial_id' => 'required|image|max:4048',
            'proof_of_domicile' => 'required|image|max:4048',
            'walk' => 'required|boolean',
            'availability_days' => 'required|array',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i',
            'city' => 'required|string',
            'address' => 'required|string',
        ]);

        if (!$request->walk) {
            $request->validate([
                'vehicle_make' => 'required|string|max:255',
                'vehicle_model' => 'required|string|max:255',
                'vehicle_year' => 'required|string|max:255',
                'vehicle_plate' => 'required|string|max:255',
                'vehicle_color' => 'required|string|max:255',
                'mean_of_transport' => 'required|string|max:255',
            ]);
        }

        $photoOfFacialIdPath = 'drivers/local/' . time() . '_proof.' . $request->file('photo_of_facial_id')->extension();
        $request->file('photo_of_facial_id')->move(public_path('drivers/local'), $photoOfFacialIdPath);

        $proofOfDomicilePath = 'drivers/local/' . time() . '_domicile.' . $request->file('proof_of_domicile')->extension();
        $request->file('proof_of_domicile')->move(public_path('drivers/local'), $proofOfDomicilePath);

        LocalDriver::create([
            'user_id' => $user->id,
            'photo_of_facial_id' => $photoOfFacialIdPath,
            'proof_of_domicile' => $proofOfDomicilePath,
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
    }

    private function registerBusiness(Request $request, User $user)
    {
        $request->validate([
            'trade_name' => 'required|string|max:255',
            'responsible_address' => 'required|string',
            'business_address' => 'required|string',
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
            'ownership_proof' => 'required|image|max:5048',
        ]);

        $ownershipProofPath = 'businesses/' . time() . '_proof.' . $request->file('ownership_proof')->extension();
        $request->file('ownership_proof')->move(public_path('businesses'), $ownershipProofPath);

        $managers = [
            'name' => $request->manager_name,
            'phone' => $request->manager_phone,
            'email' => $request->manager_email,
            'date_of_birth' => $request->manager_date_of_birth,
        ];

        Business::create([
            'user_id' => $user->id,
            'trade_name' => $request->trade_name,
            'business_name' => $request->business_name,
            'responsible_address' => $request->responsible_address,
            'business_phone' => $request->business_phone,
            'business_email' => $request->business_email,
            'business_address' => $request->business_address,
            'business_number' => $request->business_number,
            'co_manager_details' => json_encode($managers),
            'ownership_proof' => $ownershipProofPath,
            'availability_days' => json_encode($request->availability_days),
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
        ]);
    }

    private function registerPartnerHome(Request $request, User $user)
    {
        $request->validate([
            'home_name' => 'required|string|max:255',
            'home_address' => 'required|string|max:255',
            'manager_name' => 'required|string',
            'manager_email' => 'required|email',
            'manager_date_of_birth' => 'required|date',
            'availability_days' => 'required|array',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i',
            'ownership_proof' => 'required|image|max:2048',
            'terms_of_service' => 'required|boolean',
        ]);

        $ownershipProofPath = 'partner_homes/' . time() . '_proof.' . $request->file('ownership_proof')->extension();
        $request->file('ownership_proof')->move(public_path('partner_homes'), $ownershipProofPath);

        $managers = [
            'name' => $request->manager_name,
            'email' => $request->manager_email,
            'phone' => $request->manager_phone,
            'date_of_birth' => $request->manager_date_of_birth,
        ];
        PartnerHome::create([
            'user_id' => $user->id,
            'home_name' => $request->home_name,
            'home_address' => $request->home_address,
            'manager' => json_encode($managers),
            'availability_days' => json_encode($request->availability_days),
            'ownership_proof' => $ownershipProofPath,
            'time_from' => $request->time_from,
            'time_to' => $request->time_to,
            'terms_of_service' => $request->terms_of_service,
        ]);

        event(new Registered($user));
    }
}
