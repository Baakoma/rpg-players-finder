<?php

namespace App\Http\Controllers;

use App\Exceptions\EventException;
use App\Http\Requests\CreateEventFormRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventManager;
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
            $event = $eventManager->createEvent($request->only('name', 'owner_id', 'max_users', 'public_access', 'type_id'));
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
        $updateRequest = $request->only('name', 'max_users', 'public_access', 'type_id');
        return new EventResource($eventManager->updateEvent($event, $updateRequest));
    }

    public function close(Event $event): JsonResource
    {
        $event->close();
        return new EventResource($event);
    }
}
