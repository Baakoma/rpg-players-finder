<?php

namespace App\Services;

use App\Models\Event;
use Illuminate\Support\Facades\{Auth, Log};

class EventManager
{
    public function createEvent(array $eventData): Event
    {
        $event = new Event($eventData);
        $event->save();
        $event->refresh();
        Log::info('User '.Auth::id().' created event '.$event->id);
        return $event;
    }

    public function updateEvent(Event $event, array $updateRequest): Event
    {
        $event->update($updateRequest);
        Log::info('User '.Auth::id().' updated event '.$event->id);
        return $event;
    }

    public function deleteEvent(Event $event): Event
    {
        $event->delete();
        Log::info('User '.Auth::id().' deleted event '.$event->id);
        return $event;
    }
}
