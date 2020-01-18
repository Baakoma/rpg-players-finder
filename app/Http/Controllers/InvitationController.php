<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteEventFormRequest;
use App\Http\Resources\InvitationResource;
use App\Models\Invitation;
use App\Services\InvitationManager;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationController extends Controller
{
    public function show(Invitation $invitation): JsonResource
    {
        return new InvitationResource($invitation);
    }

    public function create(InviteEventFormRequest $request, InvitationManager $invitationManager): JsonResource
    {
        $invitation = $invitationManager->creatInvitation($request->only('event_id', 'player_id'));
        return new InvitationResource($invitation);
    }

    public function delete(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        return new InvitationResource($invitationManager->deleteInvitation($invitation));
    }

    public function accept(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        return new InvitationResource($invitationManager->acceptInvitation($invitation));
    }

    public function close(Invitation $invitation): JsonResource
    {
        $invitation->closeInvitation();
        return new InvitationResource($invitation);
    }
}
