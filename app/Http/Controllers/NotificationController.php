<?php

namespace App\Http\Controllers;

use App\Http\Resources\NotificationCollectionResource;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 30);
        $page = $request->query('page', 1);
        return new NotificationCollectionResource(Notification::query()->paginate($perPage, ['*'], 'page', $page));
    }
}
