<?php

namespace App\Services;

use App\Models\Event;
use App\Models\JoinRequest;

class JoinRequestManager
{
    public function creatJoinRequest(array $joinRequestData): JoinRequest
    {
        $event = Event::query()->findOrFail($joinRequestData['event_id']);
        if ($event->playerExist($joinRequestData['player_id'])) {
            abort(400, 'You cannot create the join request');
        }
        $joinRequest = new JoinRequest($joinRequestData);
        $joinRequest->save();
        $joinRequest->refresh();
        return $joinRequest;
    }

    public function acceptJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $event = $joinRequest->event;
        if (!$event->canAccess($joinRequest->player)) {
            abort(400, 'You cannot accept the join request');
        }
        $event->players()->attach($joinRequest->player);
        $joinRequest->acceptJoinRequest();
        return $joinRequest;
    }

    public function declineJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->declineJoinRequest();
        return $joinRequest;
    }

    public function deleteJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->delete();
        return $joinRequest;
    }
}
