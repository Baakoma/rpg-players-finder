<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteEventRequest;
use App\Http\Resources\InvitationResource;
use App\Models\Invitation;
use App\Services\InvitationManager;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationController extends Controller
{
    public function show(Invitation $invitation): JsonResource
    {
        $this->authorize('view', $invitation);
        return new InvitationResource($invitation);
    }

    public function create(InviteEventRequest $request, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('create', [Invitation::class, $request]);
        $invitation = $invitationManager->createInvitation($request->only('event_id', 'player_id', 'message'));
        return new InvitationResource($invitation);
    }

    public function delete(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('delete', $invitation);
        return new InvitationResource($invitationManager->deleteInvitation($invitation));
    }

    public function accept(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $invitation);
        return new InvitationResource($invitationManager->acceptInvitation($invitation));
    }

    public function decline(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        $this->authorize('acceptOrDecline', $invitation);
        return new InvitationResource($invitationManager->declineInvitation($invitation));
    }

    public function close(Invitation $invitation): JsonResource
    {
        $this->authorize('close', $invitation);
        $invitation->closeInvitation();
        return new InvitationResource($invitation);
    }
}
