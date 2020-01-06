<?php

namespace App\Services;

use App\Exceptions\EventException;
use App\Models\Event;

class EventManager
{
    public function createEvent(array $request): Event
    {
        $event=new Event($request);
        $event->save();
        return $event;
    }
}