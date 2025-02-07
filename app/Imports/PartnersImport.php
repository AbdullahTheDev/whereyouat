<?php

namespace App\Imports;

use App\Models\PartnerHome;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PartnersImport implements ToModel, WithHeadingRow
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

        $DOB = str_replace('.', '-',trim($row['date_of_birth'], "'"));
        $ManagerDOB = str_replace('.', '-',trim($row['manager_date_of_birth'], "'"));
        // // \Log::info($DOB);
        // // Check if user exists
        $user = User::where('email', $row['email_address'])->first();

        $userData = [
            'name' => $row['name_first_name'] . " " . $row['name_surname'],
            'phone' => trim($row['telephone_number'], "'"),
            'date_of_birth' => $DOB,
            'role' => 'partner_home',
            'terms_approved' => 1,
            'updated_at' => Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
        ];

        if (!empty($row['password'])) {
            $userData['password'] = Hash::make($row['password']);
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

        // // Check if business exists
        $partnersHome = PartnerHome::where('user_id', $user->id)->first();

        $coOwnerDetails = [
            'name' => $row['name_manager_first_name'] . " " . $row['name_manager_surname'],
            'phone' => trim($row['manager_telephone_number'], "'"),
            'email' => $row['manager_email_address'],
            'date_of_birth' => $ManagerDOB,
        ];

        $partnersData = [
            'user_id' => $user->id,
            'home_name' => $row['name_the_home_or_space_as_you_wish'],
            'home_address' => $row['full_home_address'],
            'availability_days' => json_encode(explode(',', $row['give_availability_in_day_and_time_of_the_space'])),
            'time_from' => $timeFrom,
            'time_to' => $timeTo,
            'manager' => json_encode($coOwnerDetails),
            'ownership_proof' => $row['provide_proof_of_ownership_or_rental'],
            'updated_at' => Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
            'terms_of_service' => $row['terms_of_service'],
        ];

        if ($partnersHome) {
            // Update missing fields for Business
            foreach ($partnersData as $key => $value) {
                if (is_null($partnersHome->$key) && !empty($value)) {
                    $partnersHome->$key = $value;
                }
            }
            $partnersHome->save();
            return $partnersHome;
        } else {
            // Create new business record
            $partnersData['created_at'] = Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']);
            return new PartnerHome($partnersData);
        }
    }
}
