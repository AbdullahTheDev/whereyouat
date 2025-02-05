<?php

namespace App\Imports;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class DriversImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Create User
        $user = User::create([
            'name' => $row['Name'] . " " . $row['Surname'],
            'email' => $row['Email Address'],
            'phone' => $row['Telephone Number'],
            'password' => Hash::make($row['The password to access his account (must be quite easy to remember)']),
            'role' => 'driver',
            'terms_approved' => 1,
        ]);

        // Create Driver and link with User
        return new Driver([
            'user_id' => $user->id,
            'license_photo_front' => $row['Double sided photo of the driver’s license'], // Path from CSV
            'license_photo_back' => $row['Double sided photo of the driver’s license'], // Path from CSV
            'vehicle_make' => $row['Make'],
            'vehicle_model' => $row['Model'],
            'vehicle_year' => $row['Year of Release'],
            'vehicle_plate' => $row['Number Plate'],
            'vehicle_color' => $row['Color of the vehicle'],
            'vehicle_seats' => $row['Seat Number'],
            'vehicle_photo' => $row['Front-Facing Photo of the Vehicle'], // Path from CSV
            'services' => json_encode(explode(',', $row['Services Provided'])),
            'packages' => json_encode(explode(',', $row['What kind of package do you want to deliver?'])),
            'local_delivery_city' => $row['If you have chosen to offer the local delivery service, please indicate your residential address or choose the city where you would like to operate as a local delivery service.'] ?? null,
        ]);
    }
}
