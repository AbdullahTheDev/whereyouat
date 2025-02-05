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
            'name' => $row['name'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'password' => Hash::make($row['password']),
            'role' => 'driver',
            'terms_approved' => 1,
        ]);

        // Create Driver and link with User
        return new Driver([
            'user_id' => $user->id,
            'vehicle_make' => $row['vehicle_make'],
            'vehicle_model' => $row['vehicle_model'],
            'vehicle_year' => $row['vehicle_year'],
            'vehicle_plate' => $row['vehicle_plate'],
            'vehicle_color' => $row['vehicle_color'],
            'vehicle_seats' => $row['vehicle_seats'],
            'services' => json_encode(explode(',', $row['services'])),
            'packages' => json_encode(explode(',', $row['packages'])),
            'local_delivery_city' => $row['local_delivery_city'] ?? null,
        ]);
    }
}
