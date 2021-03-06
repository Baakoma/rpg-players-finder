<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventFormRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventManager;
use Illuminate\Http\Resources\Json\JsonResource;

class EventController extends Controller
{
    public function show(Event $event): JsonResource
    {
        return new EventResource($event);
    }

    public function create(CreateEventFormRequest $request, EventManager $eventManager): JsonResource
    {
        $createRequest = $request->only('name', 'owner_id', 'max_users', 'public_access', 'type_id', 'system_id', 'language_id');
        $event = $eventManager->createEvent($createRequest);
        return new EventResource($event);
    }

    public function delete(Event $event, EventManager $eventManager): JsonResource
    {
        return new EventResource($eventManager->deleteEvent($event));
    }

    public function update(UpdateEventRequest $request, Event $event, EventManager $eventManager): JsonResource
    {
        $updateRequest = $request->only('name', 'max_users', 'public_access', 'type_id', 'system_id', 'language_id');
        return new EventResource($eventManager->updateEvent($event, $updateRequest));
    }

    public function close(Event $event): JsonResource
    {
        $event->closeEvent();
        return new EventResource($event);
    }
}
