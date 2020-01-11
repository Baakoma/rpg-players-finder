<?php

namespace App\Http\Controllers;

use App\Exceptions\EventException;
use App\Http\Requests\CreateEventFormRequest;
use App\Http\Requests\InviteEventFormRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventManager;
use App\Services\InvitationManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class EventController extends Controller
{
    public function show(Event $event): JsonResource
    {
        return new EventResource($event);
    }

    public function create(CreateEventFormRequest $request, EventManager $eventManager): JsonResponse
    {
        try {
            $event = $eventManager->createEvent($request->only('name', 'user_id', 'max_users', 'public_access', 'type_id'));
            return response()->json([
                'success' => true,
                'data' => $event
            ], 200);
        } catch (EventException $exception) {
            return response()->json([
                'success' => false,], 400);
        }
    }

    public function delete(Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->deleteEvent($event));
    }

    public function update(UpdateEventRequest $request, Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->updateEvent($event, $request->only('name', 'max_users', 'public_access', 'type_id')));
    }

    public function close(Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->closeEvent($event));
    }

    public function invite(InviteEventFormRequest $request, Event $event, InvitationManager $invitationManager): JsonResource
    {
        $invitationManager->invite($event, $request->user_id);
        return new EventResource($event);
    }

    public function leave(InviteEventFormRequest $request, Event $event, InvitationManager $invitationManager): JsonResource
    {
        $invitationManager->deleteUser($event->id, $request->user_id);
        return new EventResource($event);
    }

    public function accept(InviteEventFormRequest $request, Event $event, InvitationManager $invitationManager): JsonResource
    {
        $invitationManager->acceptInvitation($event->id, $request->user_id);
        return new EventResource($event);
    }
}
