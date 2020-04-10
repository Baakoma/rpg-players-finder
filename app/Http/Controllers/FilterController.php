<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Resources\FilterResource;
use App\Models\{Profile, Filter};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class FilterController extends Controller
{
    public function create(FilterRequest $request, Profile $profile): JsonResponse
    {
        $profile->filter()->updateOrCreate([
            'camera' => $request->camera,
            'description' => $request->description
        ]);

        $filter = $profile->filter;

        $filter->systems()->sync($request->input('systems'));
        $filter->types()->sync($request->input('types'));
        $filter->languages()->sync($request->input('languages'));

        return (new FilterResource($filter))->response()->setStatusCode(201);
    }

    public function show(Profile $profile): JsonResource
    {
        return new FilterResource($profile->filter());
    }

    public function update(FilterRequest $request, Profile $profile): JsonResponse
    {
        $profile->filter()->update([
            'camera' => $request->camera,
            'description' => $request->description
        ]);

        $filter = $profile->filter;

        $filter->systems()->sync($request->input('systems'));
        $filter->types()->sync($request->input('types'));
        $filter->languages()->sync($request->input('languages'));

        return (new FilterResource($filter))->response()->setStatusCode(201);
    }

    public function destroy(Profile $profile): void
    {
        $profile->filter()->delete();
    }
}
