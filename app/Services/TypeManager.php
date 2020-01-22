<?php

namespace App\Services;

use App\Models\Type;

class TypeManager
{
    public function createType(array $systemData): Type
    {
        $type = new Type($systemData);
        $type->save();
        return $type;
    }

    public function updateType(Type $type, array $updateRequest): Type
    {
        $type->update($updateRequest);
        return $type;
    }

    public function deleteType(Type $type): Type
    {
        $type->delete();
        return $type;
    }
}
