<?php

namespace App\Http\Controllers;

use App\Http\Requests\TypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Http\Resources\TypeResource;
use App\Models\Type;
use App\Services\TypeManager;
use Illuminate\Http\Resources\Json\JsonResource;

class TypeController extends Controller
{
    public function show(Type $type): JsonResource
    {
        return new TypeResource($type);
    }

    public function index(): JsonResource
    {
        return TypeResource::collection(Type::all());
    }

    public function create(TypeRequest $request, TypeManager $typeManager): JsonResource
    {
        $type = $typeManager->createType($request->only('name', 'description'));
        return new TypeResource($type);
    }

    public function update(TypeRequest $request, Type $type, TypeManager $typeManager): JsonResource
    {
        $type = $typeManager->updateType($type, $request->only('name', 'description'));
        return new TypeResource($type);
    }

    public function delete(Type $type, TypeManager $typeManager): JsonResource
    {
        return new TypeResource($typeManager->deleteType($type));
    }
}
