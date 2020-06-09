<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemRequest;
use App\Http\Resources\SystemResource;
use App\Models\System;
use App\Services\SystemManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\{Auth, Log};

class SystemController extends Controller
{
    public function show(System $system): JsonResource
    {
        Log::info('User '.Auth::id().' viewed system '.$system->id);
        return new SystemResource($system);
    }

    public function index(): JsonResource
    {
        Log::info('User '.Auth::id().' indexed systems');
        return SystemResource::collection(System::all());
    }

    public function create(SystemRequest $request, SystemManager $systemManager): JsonResource
    {
        return new SystemResource($systemManager->createSystem($request->only('name', 'description')));
    }

    public function update(SystemRequest $request, System $system, SystemManager $systemManager): JsonResource
    {
        return new SystemResource($systemManager->updateSystem($system, $request->only('name', 'description')));
    }

    public function delete(System $system, SystemManager $systemManager): JsonResource
    {
        return new SystemResource($systemManager->deleteSystem($system));
    }
}
