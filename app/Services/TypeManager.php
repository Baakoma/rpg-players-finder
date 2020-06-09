<?php

namespace App\Services;

use App\Models\Type;
use Illuminate\Support\Facades\{Auth, Log};

class TypeManager
{
    public function createType(array $systemData): Type
    {
        $type = new Type($systemData);
        $type->save();
        Log::info('User '.Auth::id().' created type '.$type->id);
        return $type;
    }

    public function updateType(Type $type, array $updateRequest): Type
    {
        $type->update($updateRequest);
        Log::info('User '.Auth::id().' updated type '.$type->id);
        return $type;
    }

    public function deleteType(Type $type): Type
    {
        $type->delete();
        Log::info('User '.Auth::id().' deleted type '.$type->id);
        return $type;
    }
}
