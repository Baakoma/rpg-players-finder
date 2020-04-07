<?php

namespace App\Services;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;

class ProfileManager
{
    public function updateProfile(Profile $profile, UpdateProfileRequest $updateRequest): Profile
    {
        $profile->update($updateRequest->only('name', 'birth_date', 'sex', 'description'));
        $profile->languages()->sync($updateRequest->get('languages'));

        $systems = [];
        foreach ($updateRequest->systems as $system) {
            $systems[$system['system_id']] = [
                'lore_knowledge_rating' => $system['lore_knowledge_rating'],
                'mechanic_knowledge_rating' => $system['mechanic_knowledge_rating'],
                'roleplay_rating' => $system['roleplay_rating'],
                'experience' => $system['experience']
            ];
        }

        $profile->systems()->sync($systems);
        $profile->save();
        return $profile;
    }
}
