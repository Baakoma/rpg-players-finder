<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\{MyEventsResource, EventsResource, EventsHistoryResource, ProfileResource};
use App\Models\{Profile, User};
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

        $updateRequest = $request->only('name', 'birth_date', 'sex', 'description', 'languages', 'camera', 'discord');
        return new ProfileResource($profileManager->updateProfile($profile, $updateRequest, $request['systems'], $request['types']));
    }

    public function indexMyEvents(User $user, Profile $profile): JsonResource
    {
        Log::info('User '.Auth::id().' indexed his events');
        return new MyEventsResource($user);
    }

    public function indexEvents(User $user): JsonResource
    {
        Log::info('User '.Auth::id().' indexed events he participate');
        return new EventsResource($user);
    }

    public function indexEventsHistory(User $user): JsonResource
    {
        Log::info('User '.Auth::id().' indexed events he participated');
        return new EventsHistoryResource($user);
    }
}
