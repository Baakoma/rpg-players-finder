<?php

namespace App\Http\Controllers;

use App\Events\AcceptFriendsList;
use App\Events\DeclineFriendsList;
use App\Http\Requests\FriendsListRequest;
use App\Http\Resources\FriendsListResource;
use App\Http\Resources\FriendsListResourceCollection;
use App\Models\FriendsList;
use App\Services\FriendsListManager;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FriendsListController extends Controller
{
    public function index(Request $request): JsonResource
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        return new FriendsListResourceCollection(FriendsList::query()->paginate($perPage, ['*'], 'page', $page));
    }

    public function show(FriendsList $friendsList): JsonResource
    {
        return new FriendsListResource($friendsList);
    }

    public function create(FriendsListRequest $request, FriendsListManager $friendsListManager): JsonResource
    {
        return new FriendsListResource($friendsListManager->createFriendsList($request->only('friend_id', 'user_id')));
    }

    public function destroy(FriendsList $friendsList, FriendsListManager $friendsListManager): JsonResource
    {
        return new FriendsListResource($friendsListManager->destroyFriendsList($friendsList));
    }

    public function accept(FriendsList $friendsList): JsonResource
    {
        $friendsList->accept();
        $friendsList->refresh();
        event(new AcceptFriendsList($friendsList));
        return new FriendsListResource($friendsList);
    }

    public function decline(FriendsList $friendsList): JsonResource
    {
        $friendsList->decline();
        $friendsList->refresh();
        event(new DeclineFriendsList($friendsList));
        return new FriendsListResource($friendsList);
    }
}
