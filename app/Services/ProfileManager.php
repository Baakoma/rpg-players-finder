<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Arr;

class ProfileManager
{
    public function updateProfile(Profile $profile, array $updateRequest, array $updateSystems): Profile
    {
        $profile->update($updateRequest);

        $systems = [];
        foreach ($updateSystems as $system) {
            $systems[$system['id']] = Arr::where($system, function ($key) {
                return !($key === 'id');
            });
        }

        $profile->systems()->sync($systems);
        $profile->save();
        return $profile;
    }
}