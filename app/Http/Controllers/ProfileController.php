<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileController extends Controller
{
    public function show(Profile $profile): JsonResource
    {
        return new ProfileResource($profile);
    }

    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        $profile->fill([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'sex' =>$request->sex,
            'description' => $request->description
        ]);

        $profile->languages()->sync($request->get('languages'));

        $systems = [];
        foreach ($request->systems as $system)
        {
            $systems[$system['id']] = [
                'lore_knowledge_rating' => $system['lore_knowledge_rating'],
                'mechanic_knowledge_rating' => $system['mechanic_knowledge_rating'],
                'roleplay_rating' => $system['roleplay_rating'],
                'experience' => $system['experience']
            ];
        }

        $profile->systems()->sync($systems);
        $profile->save();

        return (new ProfileResource($profile))->response()->setStatusCode(201);
    }
}
