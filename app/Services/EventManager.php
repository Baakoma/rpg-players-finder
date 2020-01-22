<?php

namespace App\Services;

use App\Models\Event;

class EventManager
{
    public function createEvent(array $eventData): Event
    {
        $event = new Event($eventData);
        $event->save();
        $event->refresh();
        return $event;
    }

    public function updateEvent(Event $event, array $updateRequest): Event
    {
        $event->update($updateRequest);
        return $event;
    }

    public function deleteEvent(Event $event): Event
    {
        $event->delete();
        return $event;
    }
}
