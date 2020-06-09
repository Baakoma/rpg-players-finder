<?php

namespace App\Services;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProfileManager
{
    public function updateProfile(Profile $profile, array $updateRequest, array $systems, array $languages, array $types): Profile
    {
        $profile->update($updateRequest);

        $profile->languages()->sync($languages);
        $profile->types()->sync($types);
        $profile->systems()->sync($systems);
        $profile->save();
        Log::info('User '.Auth::id().' updated profile '.$profile->id);

        return $profile;
    }
}
