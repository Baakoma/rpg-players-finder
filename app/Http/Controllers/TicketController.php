<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Http\Resources\TicketResource;
use App\Models\{Profile, Ticket};
use App\Services\TicketManager;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketController extends Controller
{
    public function create(TicketRequest $request, Profile $profile, TicketManager $ticketManager): JsonResource
    {
        $this->authorize('createOrModify', [Ticket::class, $profile]);

        $date = $request->only('camera', 'description', 'systems', 'types', 'languages');
        return new TicketResource($ticketManager->createOrUpdateTicket($date, $profile));
    }

    public function show(Profile $profile): JsonResource
    {
        $this->authorize('view', [Ticket::class, $profile]);
        return new TicketResource($profile->ticket());
    }

    public function update(TicketRequest $request, Profile $profile, TicketManager $ticketManager): JsonResource
    {
        $this->authorize('createOrModify', [Ticket::class, $profile]);

        $data = $request->only('camera', 'description', 'systems', 'types', 'languages');
        return new TicketResource($ticketManager->createOrUpdateTicket($data, $profile));
    }

    public function destroy(Profile $profile): void
    {
        $this->authorize('createOrModify', [Ticket::class, $profile]);
        $profile->ticket()->delete();
    }
}
