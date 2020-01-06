<?php

namespace App\Http\Controllers;

use App\Exceptions\EventException;
use App\Http\Requests\CreateEventFormRequest;
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

    public function createEvents(CreateEventFormRequest $request, EventManager $eventManager): JsonResponse
    {
        abort(400);
        try {
            $event = $eventManager->createEvent($request->only('name', 'user_id', 'max_users', 'public_access'));
            return response()->json([
                'success' => true,
                'data' => $event
            ], 200);
        } catch (EventException $exception) {
            return response()->json([
                'success' => false,]);
        }
    }
}
