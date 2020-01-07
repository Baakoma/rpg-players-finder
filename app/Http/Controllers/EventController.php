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

    public function deleteEvent(Event $event): JsonResource
    {
        $event->delete();
        return $this->showEvent($event);
    }

    public function updateEvent(UpdateEventRequest $request, Event $event): JsonResource
    {
        $event->update($request->all());
        return $this->showEvent($event);
    }

    public function closeEvent(Event $event): JsonResource
    {
        $event->update(['is_active' => 0]);
        return $this->showEvent($event);
    }
}
