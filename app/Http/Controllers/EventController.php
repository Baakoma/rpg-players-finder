<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Services\EventManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\{Auth, Log};

class EventController extends Controller
{
    public function show(Event $event): JsonResource
    {
        $this->authorize('view', $event);
        Log::info('User '.Auth::id().' viewed event '.$event->id);
        return new EventResource($event);
    }

    public function create(CreateEventRequest $request, EventManager $eventManager): JsonResource
    {
        $createRequest = $request->only('name', 'owner_id', 'max_users', 'public_access', 'type_id', 'system_id', 'language_id');
        return new EventResource($eventManager->createEvent($createRequest));
    }

    public function delete(Event $event, EventManager $eventManager): JsonResource
    {
        $this->authorize('modify', $event);
        return new EventResource($eventManager->deleteEvent($event));
    }

    public function update(UpdateEventRequest $request, Event $event, EventManager $eventManager): JsonResource
    {
        $this->authorize('modify', $event);
        $updateRequest = $request->only('name', 'max_users', 'public_access', 'type_id', 'system_id', 'language_id');
        return new EventResource($eventManager->updateEvent($event, $updateRequest));
    }

    public function close(Event $event): JsonResource
    {
        $this->authorize('modify', $event);
        $event->closeEvent();
        return new EventResource($event);
    }
}
