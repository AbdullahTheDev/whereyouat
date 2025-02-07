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
        
        $timeFrom = Carbon::createFromFormat('h:i a', $row['from'])->format('h:i:s');
        $timeTo = Carbon::createFromFormat('h:i a', $row['to'])->format('h:i:s');

        $DOB = str_replace('.', '-',trim($row['date_of_birth'], "'"));
        // // \Log::info($DOB);
        // // Check if user exists
        $user = User::where('email', $row['email_address'])->first();

        $userData = [
            'name' => $row['name_first_name'] . " " . $row['name_surname'],
            'phone' => trim($row['telephone_number'], "'"),
            'date_of_birth' => $DOB,
            'role' => 'business',
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
        $business = Business::where('user_id', $user->id)->first();

        $coOwnerDetails = [
            'name' => $row['name_co_owner_first_name'] . " " . $row['name_co_owner_surname'],
            'phone' => trim($row['co_owner_telephone_number'], "'"),
            'email' => $row['co_owner_email_address'],
        ];

        $businessData = [
            'user_id' => $user->id,
            'trade_name' => $row['trade_name_legal_or_commercial'],
            'responsible_address' => $row['home_address'],
            'business_email' => $row['email_address_of_the_commercial_space'],
            'business_phone' => $row['phone_number_of_the_commercial_space'],
            'business_address' => $row['full_address_of_the_commercial_space'],
            'business_number' => $row['business_number_or_commercial_tax_number'],
            'availability_days' => json_encode(explode(',', $row['availability_of_the_partner_space_opening_days'])),
            'time_from' => $timeFrom,
            'time_to' => $timeTo,
            'co_manager_details' => json_encode($coOwnerDetails),
            'ownership_proof' => $row['proof_of_ownership_or_management_of_the_commercial_space'],
            'updated_at' => Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']),
            'general_terms' => $row['general_terms'],
        ];

        if ($business) {
            // Update missing fields for Business
            foreach ($businessData as $key => $value) {
                if (is_null($business->$key) && !empty($value)) {
                    $business->$key = $value;
                }
            }
            $business->save();
            return $business;
        } else {
            // Create new business record
            $businessData['created_at'] = Carbon::createFromFormat('M j, Y @ h:i A', $row['submission_time']);
            return new Business($businessData);
        }
    }
}
