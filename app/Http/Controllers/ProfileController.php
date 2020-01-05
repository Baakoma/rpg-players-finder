<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use App\Models\{Profile, ProfileSystem};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileController extends Controller
{
    public function show(int $id): JsonResource
    {
        return new ProfileResource(Profile::query()->findOrFail($id));
    }

    public function update(UpdateProfileRequest $request, int $id): JsonResponse
    {
        $profile = Profile::query()->find($id);
        $profile->fill([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'description' => $request->description
        ]);

        $systems = [];
        foreach ($request->systems as $system)
        {
            $data = [$system['id'] => [
                'lore_knowledge_rating' => $system['lore_knowledge_rating'],
                'mechanic_knowledge_rating' => $system['mechanic_knowledge_rating'],
                'roleplay_rating' => $system['roleplay_rating'],
                'experience' => $system['experience']
            ]];
            array_push($systems, $data);
        }

        $profile->systems()->sync($systems[0]); //przyjmuje tylko pojedyncze elementy, a nie może całej tablicy
        $profile->save();                       //issue lvl 20
        return response()->json(
            new ProfileResource($profile)
        , 201);
    }
}
