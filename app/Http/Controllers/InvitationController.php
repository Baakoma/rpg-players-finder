<?php

namespace App\Http\Controllers;

use App\Exceptions\ApiException;
use App\Http\Requests\InviteEventFormRequest;
use App\Http\Resources\InvitationResource;
use App\Models\Invitation;
use App\Services\InvitationManager;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationController extends Controller
{
    public function show(Invitation $invitation): JsonResource
    {
        return new InvitationResource($invitation);
    }

    public function create(InviteEventFormRequest $request, InvitationManager $invitationManager): JsonResponse
    {
        $invitation = $invitationManager->creatInvitation($request->only('event_id', 'player_id'));
        return response()->json(['data' => $invitation], 201);
    }

    public function delete(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        return new InvitationResource($invitationManager->deleteInvitation($invitation));
    }

    public function accept(Invitation $invitation, InvitationManager $invitationManager): JsonResource
    {
        try {
            return new InvitationResource($invitationManager->acceptInvitation($invitation));
        } catch (ApiException $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'exception' => ['You cannot accept the invitation'],
            ]);
        }
    }

    public function close(Invitation $invitation): JsonResource
    {
        $invitation->close();
        return new InvitationResource($invitation);
    }
}
