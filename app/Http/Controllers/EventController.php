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
    public function showEvent(Event $event): JsonResource
    {
        return new EventResource($event);
    }

    public function createEvent(CreateEventFormRequest $request, EventManager $eventManager): JsonResponse
    {
        try {
            $event = $eventManager->createEvent($request->all());
            return response()->json([
                'success' => true,
                'data' => $event
            ], 200);
        } catch (EventException $exception) {
            return response()->json([
                'success' => false,], 400);
        }
    }

    public function deleteEvent(Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->deleteEvent($event));
    }

    public function updateEvent(UpdateEventRequest $request, Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->updateEvent($event, $request->only('name', 'max_users', 'public_access')));
    }

    public function closeEvent(Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->closeEvent($event));
    }
}
