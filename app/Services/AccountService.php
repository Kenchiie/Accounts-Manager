<?php

namespace App\Services;

use App\Models\Account;

class AccountService
{
    public function updateMobileNumbers($account, $request)
    {
        $submittedMobileNumbers = $request['mobile_numbers'] ?? [];
        $existingMobileNumbers = $account->mobileNumbers->pluck('number')->toArray();

        // Remove mobile numbers that are not in the submitted data
        $numbersToDelete = array_diff($existingMobileNumbers, $submittedMobileNumbers);
        if (!empty($numbersToDelete)) {
            $account->mobileNumbers()->whereIn('number', $numbersToDelete)->delete();
        }

        // Add or update mobile numbers from the submitted data
        if ($submittedMobileNumbers) {
            foreach ($submittedMobileNumbers as $mobile) {
                if ($mobile) {
                    $account->mobileNumbers()->updateOrCreate(['number' => $mobile]);
                }
            }
        }
    }
}
