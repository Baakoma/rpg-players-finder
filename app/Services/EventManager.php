<?php

namespace App\Services;

use App\Models\Event;

class EventManager
{
    public function createEvent(array $createEventRequest): Event
    {
        $event = new Event($createEventRequest);
        $event->save();
        return $event;
    }

    public function updateEvent(Event $event, array $updateEventRequest): Event
    {
        $event->update($updateEventRequest);
        return $event;
    }

    public function closeEvent(Event $event)
    {
        $event->update(['is_active' => 0]);
        return $event;
    }

    public function deleteEvent(Event $event): Event
    {
        $event->delete();
        return $event;
    }
}
