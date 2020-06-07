<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinRequestEventRequest;
use App\Http\Resources\JoinRequestResource;
use App\Models\JoinRequest;
use App\Services\JoinRequestManager;
use Illuminate\Http\Resources\Json\JsonResource;

class JoinRequestController extends Controller
{
    public function show(JoinRequest $joinRequest): JsonResource
    {
        $this->authorize('view', $joinRequest);
        return new JoinRequestResource($joinRequest);
    }

    public function create(JoinRequestEventRequest $request, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('create', [JoinRequest::class, $request]);
        $joinRequest = $joinRequestManager->create($request->only('event_id', 'player_id', 'message'));
        return new JoinRequestResource($joinRequest);
    }

    public function accept(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $joinRequest);
        return new JoinRequestResource($joinRequestManager->accept($joinRequest));
    }

    public function decline(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $joinRequest);
        return new JoinRequestResource($joinRequestManager->decline($joinRequest));
    }

    public function close(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('close', $joinRequest);
        return new JoinRequestResource($joinRequestManager->close($joinRequest));
    }
}
