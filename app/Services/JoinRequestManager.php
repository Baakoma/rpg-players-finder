<?php

namespace App\Services;

use App\Models\JoinRequest;

class JoinRequestManager
{
    public function creatJoinRequest(array $joinRequestData): JoinRequest
    {
        $joinRequest = new JoinRequest($joinRequestData);
        $joinRequest->save();
        $joinRequest->refresh();
        return $joinRequest;
    }

    public function acceptJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $event = $joinRequest->event;
        if (!$event->canAccess($joinRequest->player)) {
            abort(400, 'You cannot accept the invitation');
        }
        $event->players()->attach($joinRequest->player);
        $joinRequest->acceptJoinRequest();
        return $joinRequest;
    }

    public function deleteJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->delete();
        return $joinRequest;
    }
}
