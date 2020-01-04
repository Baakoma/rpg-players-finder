<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\{Profile, ProfileSystem};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProfileResource;

class ProfileController extends Controller
{
    public function show(int $id): JsonResource
    {
        return new ProfileResource(Profile::query()->findOrFail($id));
    }

    public function update(UpdateProfileRequest $request, int $id): JsonResponse
    {
        $profile = Profile::query()->find($id);
        $profile->name = $request->input('name');
        $profile->birth_date = $request->input('birth_date');
        $profile->description = $request->input('description');
        $profile->save();
        $systems =  $request->systems;

        foreach ($systems as $system)
        {
           foreach ($profile->profileSystem as $profileSystem)
           {
               if ($system['id'] === $profileSystem['id'])
               {
                    $profileSystem = ProfileSystem::query()->find($profileSystem['id']);
                    $profileSystem->lore_knowledge_rating = $system['lore_knowledge_rating'];
                    $profileSystem->mechanic_knowledge_rating = $system['mechanic_knowledge_rating'];
                    $profileSystem->roleplay_rating = $system['roleplay_rating'];
                    $profileSystem->experience = $system['experience'];
                    $profileSystem->save();
                }
           }
        }
        return response()->json(
            new ProfileResource(Profile::query()->find($id))
        , 201);
    }
}
