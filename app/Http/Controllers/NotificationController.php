<?php

namespace App\Http\Controllers;

use App\Http\Requests\InviteEventRequest;
use App\Http\Requests\JoinRequestEventRequest;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\JoinRequestResource;
use App\Http\Resources\MessageResource;
use App\Http\Resources\NotificationCollectionResource;
use App\Models\Message;
use App\Models\Notification;
use App\Services\InvitationManager;
use App\Services\JoinRequestManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        return new NotificationCollectionResource(Notification::query()->paginate($perPage, ['*'], 'page', $page));
    }

    public function test1(InviteEventRequest $request, InvitationManager $invitationManager): JsonResource
    {
        $invitation = $invitationManager->createInvitation($request->only('event_id', 'player_id', 'message'));
        return new InvitationResource($invitation);
    }

    public function test2(JoinRequestEventRequest $request, JoinRequestManager $joinRequestManager): JsonResource
    {
        $joinRequest = $joinRequestManager->createJoinRequest($request->only('event_id', 'player_id', 'message'));
        return new JoinRequestResource($joinRequest);
    }

    public function test3(Request $request): JsonResource
    {
        $message = new Message($request->only('message'));
        $message->save();
        return new MessageResource($message);
    }
}
