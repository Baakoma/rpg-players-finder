<?php


namespace App\Services;


use App\Models\System;

class SystemManager
{
    public function createSystem(array $systemData): System
    {
        $system = new System($systemData);
        $system->save();
        return $system;
    }

    public function updateSystem(System $system, array $updateRequest): System
    {
        $system->update($updateRequest);
        return $system;
    }

    public function deleteSystem(System $system): System
    {
        $system->delete();
        return $system;
    }
}
