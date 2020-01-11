<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteEventFormRequest;
use App\Http\Resources\InvitationResource;
use App\Models\Event;
use App\Models\Invitation;
use App\Services\InvitationManager;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationController extends Controller
{
    public function show(Invitation $invitation,Event $event):JsonResource
    {
        return new InvitationResource($invitation);
    }

    public function create(InviteEventFormRequest $request, Event $event, InvitationManager $invitationManager): JsonResource
    {
        return new InvitationResource($invitationManager->creatInvitation($event->id, $request->user_id));
    }

    public function delete(Invitation $invitation, Event $event, InvitationManager $invitationManager): JsonResource
    {
        return new InvitationResource($invitationManager->deleteInvitation($invitation));
    }

    public function accept(Invitation $invitation, Event $event): JsonResource
    {
        $invitation->accept();
        return new InvitationResource($invitation);
    }

    public function close(Invitation $invitation, Event $event): JsonResource
    {
        $invitation->close();
        return new InvitationResource($invitation);
    }
}
