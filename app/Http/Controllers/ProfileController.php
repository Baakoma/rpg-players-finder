<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Services\ProfileManager;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileController extends Controller
{
    public function show(Profile $profile): JsonResource
    {
        return new ProfileResource($profile);
    }

    public function update(UpdateProfileRequest $request, Profile $profile, ProfileManager $profileManager): JsonResource
    {
        $this->authorize('update', $profile);

        $updateRequest = $request->only('name', 'birth_date', 'sex', 'description', 'languages', 'camera', 'discord');
        return new ProfileResource($profileManager->updateProfile($profile, $updateRequest, $request['systems'], $request['types']));
    }
}
