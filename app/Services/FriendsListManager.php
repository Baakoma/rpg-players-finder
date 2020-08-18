<?php

namespace App\Services;

use App\Events\FriendsListRequest;
use App\Events\RemovingFromFriendsList;
use App\Models\FriendsList;

class FriendsListManager
{
    public function createFriendsList(array $data): FriendsList
    {
        $friendsList = new FriendsList($data);
        $friendsList->save();
        event(new FriendsListRequest($friendsList));
        return $friendsList;
    }

    public function destroyFriendsList(FriendsList $friendsList): FriendsList
    {
        event(new RemovingFromFriendsList($friendsList));
        $friendsList->delete();
        return $friendsList;
    }
}
