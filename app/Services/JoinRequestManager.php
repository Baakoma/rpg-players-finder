<?php

namespace App\Services;

use App\Models\Event;
use App\Models\JoinRequest;
use Illuminate\Support\Facades\{Auth, Log};

class JoinRequestManager
{
    public function createJoinRequest(array $joinRequestData): JoinRequest
    {
        $event = Event::query()->findOrFail($joinRequestData['event_id']);
        if ($event->playerExist($joinRequestData['player_id'])) {
            abort(400, 'You cannot create the join request');
        }
        $joinRequest = new JoinRequest($joinRequestData);
        $joinRequest->save();
        $joinRequest->refresh();
        Log::info('User '.Auth::id().' created join-request '.$joinRequest->id);
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
        Log::info('User '.Auth::id().' accepted join-request '.$joinRequest->id);
        return $joinRequest;
    }

    public function declineJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->declineJoinRequest();
        Log::info('User '.Auth::id().' declined join-request '.$joinRequest->id);
        return $joinRequest;
    }

    public function deleteJoinRequest(JoinRequest $joinRequest): JoinRequest
    {
        $joinRequest->delete();
        Log::info('User '.Auth::id().' deleted join-request '.$joinRequest->id);
        return $joinRequest;
    }
}
