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
    public function showEvent(int $id): JsonResource
    {
        return new EventResource(Event::query()->findOrFail($id));
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

    public function deleteEvent(int $id): JsonResource
    {
        $event = $this->showEvent($id);
        Event::query()->findOrFail($id)->delete();
        return $event;
    }

    public function updateEvent(UpdateEventRequest $request, int $id): JsonResource
    {
        $event = Event::query()->findOrFail($id);
        $event->update($request->all());
        return $this->showEvent($id);
    }
}
