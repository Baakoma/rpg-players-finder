<?php


namespace App\Services;


use App\Models\Event;
use App\Models\Invitation;

class InvitationManager
{
    public function invite(Event $event, int $userId)
    {
        if ($event->max_users > $event->invitation()->count()) {
            Invitation::query()->firstOrCreate(['event_id' => $event->id, 'user_id' => $userId]);
        }
    }

    public function deleteUser(int $eventId, int $userId)
    {
        $invitation = Invitation::query()->where('event_id', '=', $eventId)->where('user_id', '=', $userId)->firstOrFail();
        $invitation->delete();
    }

    public function acceptInvitation(int $eventId, int $userId)
    {
        $invitation = Invitation::query()->where('event_id', '=', $eventId)->where('user_id', '=', $userId)->firstOrFail();
        $invitation->update(['accepted' => 1]);
    }
}
