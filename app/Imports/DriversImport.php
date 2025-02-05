<?php

namespace App\Imports;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DriversImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Log::info($row);
        $user = User::where('email', $row['email_address'])->first();

        // If user exists, skip both user and driver creation
        if ($user) {
            return null;
        }

        // Create User
        $user = User::create([
            'name' => $row['name'] . " " . $row['surname'],
            'email' => $row['email_address'],
            'phone' => trim($row['telephone_number'], "'"), // Remove single quotes if present
            'password' => Hash::make($row['the_password_to_access_his_account_must_be_quite_easy_to_remember']),
            'role' => 'driver',
            'terms_approved' => 1,
            'created_at' => \Carbon\Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
            'updated_at' => \Carbon\Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
        ]);

        // Create Driver and link with User
        return new Driver([
            'user_id' => $user->id,
            'license_photo_front' => $row['double_sided_photo_of_the_drivers_license'], // Path from CSV
            'license_photo_back' => $row['double_sided_photo_of_the_drivers_license'], // Path from CSV
            'vehicle_make' => $row['make'],
            'vehicle_model' => $row['model'],
            'vehicle_year' => $row['year_of_release'],
            'vehicle_plate' => $row['number_plate'],
            'vehicle_color' => $row['color_of_the_vehicle'],
            'vehicle_seats' => $row['seat_number'],
            'vehicle_photo' => $row['front_facing_photo_of_the_vehicle'], // Path from CSV
            'services' => json_encode(explode(',', $row['services_provided'])),
            'packages' => json_encode(explode(',', $row['what_kind_of_package_do_you_want_to_deliver'])),
            'local_delivery_city' => $row['if_you_have_chosen_to_offer_the_local_delivery_service_please_indicate_your_residential_address_or_choose_the_city_where_you_would_like_to_operate_as_a_local_delivery_service'] ?? null,
            'created_at' => \Carbon\Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
            'updated_at' => \Carbon\Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
        ]);
    }
}
