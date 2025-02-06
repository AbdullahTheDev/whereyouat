<?php

namespace App\Imports;

use App\Models\LocalDriver;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LocalDriversImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        \Log::info($row);

        $timeFrom = Carbon::createFromFormat('h:i a', $row['from'])->format('h:i:s');
        $timeTo = Carbon::createFromFormat('h:i a', $row['to'])->format('h:i:s');

        \Log::info($timeFrom);
        \Log::info($timeTo);
        
        $DOB = str_replace('.', '-', trim($row['date_of_birth'], "'"));
        // \Log::info($DOB);
        // Check if user exists
        $user = User::where('email', $row['email_address'])->first();

        $userData = [
            'name' => $row['name'] . " " . $row['surname'],
            'phone' => trim($row['telephone_number'], "'"),
            'date_of_birth' => $DOB,
            'role' => 'local_driver',
            'terms_approved' => 1,
            'updated_at' => Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
        ];

        if (!empty($row['the_password_to_access_his_account_must_be_quite_easy_to_remember'])) {
            $userData['password'] = Hash::make($row['the_password_to_access_his_account_must_be_quite_easy_to_remember']);
        }

        if ($user) {
            // Update missing fields
            foreach ($userData as $key => $value) {
                if (is_null($user->$key) && !empty($value)) {
                    $user->$key = $value;
                }
            }
            $user->save();
        } else {
            // Create new user
            $userData['email'] = $row['email_address'];
            $userData['created_at'] = Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']);
            $user = User::create($userData);
        }

        // Check if driver exists
        $driver = LocalDriver::where('user_id', $user->id)->first();

        $driverData = [
            'user_id' => $user->id,
            'photo_of_facial_id' => $row['photo_of_a_facial_id'],
            'proof_of_domicile' => $row['proof_of_domicile'],
            'vehicle_make' => $row['make'],
            'vehicle_model' => $row['model'],
            'vehicle_year' => $row['year_of_release'],
            'vehicle_plate' => $row['number_plate'],
            'vehicle_color' => $row['color_of_the_vehicle'],
            'walk' => $row['do_you_walk_for_your_deliveries_or_use_a_means_of_transport'],
            'mean_of_transport' => $row['what_is_your_means_of_transport'],
            'address' => $row['full_residential_address'],
            'city' => $row['city_and_residential_address_to_determine_your_preferred_area_of_activity'],
            'availability_days' => json_encode(explode(',', $row['availability_days'])),
            'time_from' => $timeFrom,
            'time_to' => $timeTo,
        ];

        if ($driver) {
            // Update missing fields for Driver
            foreach ($driverData as $key => $value) {
                if (is_null($driver->$key) && !empty($value)) {
                    $driver->$key = $value;
                }
            }
            $driver->save();
            return $driver;
        } else {
            // Create new driver record
            return new LocalDriver($driverData);
        }
    }
}


// SQLSTATE[HY000]: General error: 1364 Field 'time_from' doesn't have a default value 
// (Connection: mysql, SQL: insert into `local_drivers` (`user_id`, `photo_of_facial_id`, `proof_of_domicile`, `vehicle_make`, `vehicle_model`, 
// `vehicle_year`, `vehicle_plate`, `vehicle_color`, `walk`, `mean_of_transport`, `address`, `city`, `availability_days`) values 
// (41, https://wya.onlinedemolinks.com/wp-content/uploads/forminator/770_1515860c6cea87367b55ea7ef4b838b0/uploads/uxvrsJBrapLV-freepik__adjust__62564.png, 
// https://wya.onlinedemolinks.com/wp-content/uploads/forminator/770_1515860c6cea87367b55ea7ef4b838b0/uploads/lnncY445gKiN-freepik__adjust__62565.png, 
// 2023, 2023, 2023, 696, Gray, 1, two, Qui consectetur omn, Karachi, ["monday"," tuesday"," wednesday"," thursday"," friday"," saturday"," sunday"]))