<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteEventRequest;
use App\Http\Resources\InvitationResource;
use Illuminate\Support\Facades\{Auth, Log};
use App\Models\Invitation;
use App\Services\InvitationManager;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationController extends Controller
{
    public function show(Invitation $invitation): JsonResource
    {
        $this->authorize('view', $invitation);
        Log::info('User '.Auth::id().' viewed invitation '.$invitation->id);
        return new InvitationResource($invitation);
    }

    public function create(InviteEventRequest $request, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('create', [Invitation::class, $request]);
        $invitation = $invitationManager->create($request->only('event_id', 'player_id', 'message'));
        return new InvitationResource($invitation);
    }

    public function accept(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $invitation);
        return new InvitationResource($invitationManager->accept($invitation));
    }

    public function decline(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $invitation);
        return new InvitationResource($invitationManager->decline($invitation));
    }

    public function close(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('close', $invitation);
        return new InvitationResource($invitationManager->close($invitation));
    }
}
