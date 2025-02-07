<?php

namespace App\Imports;

use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BusinessesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        \Log::info($row);
        
        // $DOB = str_replace('.', '-',trim($row['date_of_birth'], "'"));
        // // \Log::info($DOB);
        // // Check if user exists
        // $user = User::where('email', $row['email_address'])->first();

        // $userData = [
        //     'name' => $row['name'] . " " . $row['surname'],
        //     'phone' => trim($row['telephone_number'], "'"),
        //     'date_of_birth' => $DOB,
        //     'role' => 'driver',
        //     'terms_approved' => 1,
        //     'updated_at' => Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
        // ];

        // if (!empty($row['the_password_to_access_his_account_must_be_quite_easy_to_remember'])) {
        //     $userData['password'] = Hash::make($row['the_password_to_access_his_account_must_be_quite_easy_to_remember']);
        // }

        // if ($user) {
        //     // Update missing fields
        //     foreach ($userData as $key => $value) {
        //         if (is_null($user->$key) && !empty($value)) {
        //             $user->$key = $value;
        //         }
        //     }
        //     $user->save();
        // } else {
        //     // Create new user
        //     $userData['email'] = $row['email_address'];
        //     $userData['created_at'] = Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']);
        //     $user = User::create($userData);
        // }

        // // Check if driver exists
        // $driver = Business::where('user_id', $user->id)->first();

        // $driverData = [
        //     'user_id' => $user->id,
        //     'license_photo_front' => $row['double_sided_photo_of_the_drivers_license'],
        //     'license_photo_back' => $row['double_sided_photo_of_the_drivers_license'],
        //     'vehicle_make' => $row['make'],
        //     'vehicle_model' => $row['model'],
        //     'vehicle_year' => $row['year_of_release'],
        //     'vehicle_plate' => $row['number_plate'],
        //     'vehicle_color' => $row['color_of_the_vehicle'],
        //     'vehicle_seats' => $row['seat_number'],
        //     'vehicle_photo' => $row['front_facing_photo_of_the_vehicle'],
        //     'services' => json_encode(explode(',', $row['services_provided'])),
        //     'packages' => json_encode(explode(',', $row['what_kind_of_package_do_you_want_to_deliver'])),
        //     'local_delivery_city' => $row['if_you_have_chosen_to_offer_the_local_delivery_service_please_indicate_your_residential_address_or_choose_the_city_where_you_would_like_to_operate_as_a_local_delivery_service'] ?? null,
        //     'updated_at' => Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
        // ];

        // if ($driver) {
        //     // Update missing fields for Driver
        //     foreach ($driverData as $key => $value) {
        //         if (is_null($driver->$key) && !empty($value)) {
        //             $driver->$key = $value;
        //         }
        //     }
        //     $driver->save();
        //     return $driver;
        // } else {
        //     // Create new driver record
        //     $driverData['created_at'] = Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']);
        //     return new Business($driverData);
        // }
    }
}
