<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Services\TypeManager;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\{Auth, Log};

class TypeController extends Controller
{
    public function show(Type $type): JsonResource
    {
        Log::info('User '.Auth::id().' viewed type '.$type->id);
        return new TypeResource($type);
    }

    public function index(): JsonResource
    {
        Log::info('User '.Auth::id().' indexed types');
        return TypeResource::collection(Type::all());
    }

    public function create(TypeRequest $request, TypeManager $typeManager): JsonResource
    {
        return new TypeResource($typeManager->createType($request->only('name', 'description')));
    }

    public function update(TypeRequest $request, Type $type, TypeManager $typeManager): JsonResource
    {
        return new TypeResource($typeManager->updateType($type, $request->only('name', 'description')));
    }

    public function delete(Type $type, TypeManager $typeManager): JsonResource
    {
        return new TypeResource($typeManager->deleteType($type));
    }
}
