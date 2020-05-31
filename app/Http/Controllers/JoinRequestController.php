<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinRequestEventFormRequest;
use App\Http\Resources\JoinRequestResource;
use App\Models\JoinRequest;
use App\Services\JoinRequestManager;
use Illuminate\Http\Resources\Json\JsonResource;

class JoinRequestController extends Controller
{
    public function show(JoinRequest $joinRequest): JsonResource
    {
        return new JoinRequestResource($joinRequest);
    }

    public function create(JoinRequestEventFormRequest $request, JoinRequestManager $joinRequestManager): JsonResource
    {
        $joinRequest = $joinRequestManager->creatJoinRequest($request->only('event_id', 'player_id', 'message'));
        return new JoinRequestResource($joinRequest);
    }

    public function delete(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        return new JoinRequestResource($joinRequestManager->deleteJoinRequest($joinRequest));
    }

    public function accept(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        return new JoinRequestResource($joinRequestManager->acceptJoinRequest($joinRequest));
    }

    public function decline(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        return new JoinRequestResource($joinRequestManager->declineJoinRequest($joinRequest));
    }

    public function close(JoinRequest $joinRequest): JsonResource
    {
        $joinRequest->closeJoinRequest();
        return new JoinRequestResource($joinRequest);
    }
}
