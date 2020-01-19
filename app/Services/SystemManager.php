<?php

namespace App\Services;

use App\Models\System;

class SystemManager
{
    public function createSystem(array $systemData, array $linksData): System
    {
        $system = new System($systemData);
        $system->save();
        $system->links()->createMany($linksData);
        return $system;
    }

    public function updateSystem(System $system, array $updateSystem, array $updateLinks): System
    {
        $system->update($updateSystem);
        $system->syncLinks($updateLinks);
        $system->refresh();
        return $system;
    }

    public function deleteSystem(System $system): System
    {
        $system->delete();
        return $system;
    }
}
