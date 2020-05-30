<?php

namespace App\Http\Controllers;

use App\Http\Requests\SystemRequest;
use App\Http\Resources\SystemResource;
use App\Models\System;
use App\Services\SystemManager;
use Illuminate\Http\Resources\Json\JsonResource;

class SystemController extends Controller
{
    public function show(System $system): JsonResource
    {
        return new SystemResource($system);
    }

    public function index(): JsonResource
    {
        return SystemResource::collection(System::all());
    }

    public function create(SystemRequest $request, SystemManager $systemManager): JsonResource
    {
        return new SystemResource($systemManager->createSystem($request->only('name', 'description', 'links')));
    }

    public function update(SystemRequest $request, System $system, SystemManager $systemManager): JsonResource
    {
        return new SystemResource($systemManager->updateSystem($system, $request->only('name', 'description', 'links')));
    }

    public function delete(System $system, SystemManager $systemManager): JsonResource
    {
        return new SystemResource($systemManager->deleteSystem($system));
    }
}
