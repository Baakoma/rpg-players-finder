<?php

namespace App\Services;

use App\Models\Event;

class EventManager
{
    public function createEvent(array $eventRequest): Event
    {
        $event = new Event($eventRequest);
        $event->save();
        return $event;
    }

    public function updateEvent(Event $event, array $updateRequest): Event
    {
        $event->update($updateRequest);
        return $event;
    }

    public function closeEvent(Event $event): Event
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
