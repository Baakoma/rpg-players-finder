<?php

namespace App\Http\Controllers;

use App\Http\Requests\JoinRequestEventRequest;
use App\Http\Resources\JoinRequestResource;
use App\Models\JoinRequest;
use App\Services\JoinRequestManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\{Auth, Log};

class JoinRequestController extends Controller
{
    public function show(JoinRequest $joinRequest): JsonResource
    {
        $this->authorize('view', $joinRequest);
        Log::info('User '.Auth::id().' viewed join-request '.$joinRequest->id);
        return new JoinRequestResource($joinRequest);
    }

    public function create(JoinRequestEventRequest $request, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('create', [JoinRequest::class, $request]);
        $joinRequest = $joinRequestManager->createJoinRequest($request->only('event_id', 'player_id', 'message'));
        return new JoinRequestResource($joinRequest);
    }

    public function accept(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $joinRequest);
        return new JoinRequestResource($joinRequestManager->acceptJoinRequest($joinRequest));
    }

    public function decline(JoinRequest $joinRequest, JoinRequestManager $joinRequestManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $joinRequest);
        return new JoinRequestResource($joinRequestManager->declineJoinRequest($joinRequest));
    }

    public function close(JoinRequest $joinRequest): JsonResource
    {
        $this->authorize('close', $joinRequest);
        $joinRequest->closeJoinRequest();
        Log::info('User '.Auth::id().' closed join-request '.$joinRequest->id);
        return new JoinRequestResource($joinRequest);
    }
}
