<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProfileResource;
use App\Profile;
use App\ProfileSystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileController extends Controller
{
    public function show(int $id): JsonResource
    {
        return new ProfileResource(Profile::query()->findOrFail($id));
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $profile = Profile::query()->find($id);
        $profile->name = $request->input('name', $profile->name);
        $profile->birth_date = $request->input('birth_date', $profile->birth_date);
        $profile->description = $request->input('description', $profile->description);
        foreach ($request->input('system.id') as $systemId){
            foreach ($profile->profileSystem->id as $profileId){
                if($systemId == $profileId){
                    $system = ProfileSystem::query()->find($systemId);
                    $system->lore_knowledge_rating = $request->systems->$systemId->input('lore_knowledge_rating');
                    $system->mechanic_knowledge_rating = $request->systems->$systemId->input('mechanic_knowledge_rating');
                    $system->roleplay_rating = $request->systems->$systemId->input('roleplay_rating');
                    $system->experience = $request->systems->$systemId->input('experience');
                }
            }
        }
        //$profile->languages;
        $profile->save();
        return response()->json([
            new ProfileResource(Profile::query()->find($id))
        ], 201);
    }
}
