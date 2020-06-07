<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Services\ProfileManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\{Auth, Log};

class ProfileController extends Controller
{
    public function show(Profile $profile): JsonResource
    {
        Log::info('User '.Auth::id().' viewed profile '.$profile->id);
        return new ProfileResource($profile);
    }

    public function update(UpdateProfileRequest $request, Profile $profile, ProfileManager $profileManager): JsonResource
    {
        $this->authorize('update', $profile);
        $updateRequest = $request->only('name', 'birth_date', 'sex', 'description', 'languages');
        return new ProfileResource($profileManager->updateProfile($profile, $updateRequest, $request->input('systems')));
    }
}
