<?php

namespace App\Services;

use App\Models\Event;
use App\Models\JoinRequest;

class JoinRequestManager
{
    public function create(array $data): JoinRequest
    {
        $event = Event::query()->findOrFail($data['event_id']);
        if ($event->playerExist($data['player_id'])) {
            abort(400, 'You cannot create the join request');
        }
        $joinRequest = new JoinRequest($data);
        $joinRequest->save();
        $joinRequest->refresh();
        return $joinRequest;
    }

    public function accept(JoinRequest $joinRequest): JoinRequest
    {
        $event = $joinRequest->event;
        if (!$event->canAccess($joinRequest->player)) {
            abort(400, 'You cannot accept the join request');
        }
        $event->players()->attach($joinRequest->player);
        $joinRequest->acceptJoinRequest();
        return $joinRequest;
    }

    public function decline(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->declineJoinRequest();
        return $joinRequest;
    }

    public function close(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->closeJoinRequest();;
        return $joinRequest;
    }
}
