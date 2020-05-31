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
        $this->authorize('createOrModify', [Ticket::class, $profile]);
        $profile->ticket()->updateOrCreate([
            'camera' => $request->camera,
            'description' => $request->description
        ]);

        $ticket = $profile->ticket;

        $ticket->systems()->sync($request->get('systems'));
        $ticket->types()->sync($request->get('types'));
        $ticket->languages()->sync($request->get('languages'));

        return (new TicketResource($ticket))->response()->setStatusCode(201);
    }

    public function show(Profile $profile): JsonResource
    {
        $this->authorize('view', [Ticket::class, $profile]);
        return new TicketResource($profile->ticket());
    }

    public function update(TicketRequest $request, Profile $profile): JsonResponse
    {
        $this->authorize('createOrModify', [Ticket::class, $profile]);
        $profile->ticket()->update([
            'camera' => $request->camera,
            'description' => $request->description
        ]);

        $ticket = $profile->ticket;

        $ticket->systems()->sync($request->get('systems'));
        $ticket->types()->sync($request->get('types'));
        $ticket->languages()->sync($request->get('languages'));

        return (new TicketResource($ticket))->response()->setStatusCode(201);
    }

    public function destroy(Profile $profile): void
    {
        $this->authorize('createOrModify', [Ticket::class, $profile]);
        $profile->ticket()->delete();
    }
}
