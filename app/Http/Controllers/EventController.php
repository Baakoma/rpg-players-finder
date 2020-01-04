<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventResource;
use App\Models\Event;
use Illuminate\Http\Resources\Json\JsonResource;

class EventController extends Controller
{
    public function showEvent(int $id): JsonResource
    {
        return new EventResource(Event::query()->findOrFail($id));
    }
}
