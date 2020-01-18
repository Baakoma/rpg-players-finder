<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\{Profile, Ticket};
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketController extends Controller
{
    public function create(TicketRequest $request, Profile $profile): JsonResponse
    {
        $profile->ticket()->updateOrCreate([
            'camera' => $request->camera,
            'description' => $request->description
        ]);

        $ticket = Ticket::query()->where('profile_id', $profile->id)->firstOrFail();

        $ticket->systems()->sync($request->get('systems'));
        $ticket->types()->sync($request->get('types'));
        $ticket->languages()->sync($request->get('languages'));

        return (new TicketResource($profile))->response()->setStatusCode(201);
    }

    public function show(Profile $profile): JsonResource
    {
        return new TicketResource($profile);
    }

    public function update(TicketRequest $request, Profile $profile): JsonResponse
    {
        $profile->ticket()->update([
            'camera' => $request->camera,
            'description' => $request->description
        ]);

        $ticket = Ticket::query()->where('profile_id', $profile->id)->firstOrFail();

        $ticket->systems()->sync($request->get('systems'));
        $ticket->types()->sync($request->get('types'));
        $ticket->languages()->sync($request->get('languages'));

        return (new TicketResource($profile))->response()->setStatusCode(201);
    }

    public function destroy(Profile $profile): void
    {
        $profile->ticket()->delete();
    }
}
