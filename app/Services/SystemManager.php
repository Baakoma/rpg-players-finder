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
        $system->save();
        $system->refresh();
        return $system;
    }

    public function updateSystem(System $system, array $updateSystem, array $updateLinks): System
    {
        $system->update($updateSystem);
        foreach ($updateLinks as $updateLink) {
            $system->links()->update([
                'name' => $updateLink['name'],
                'url' => $updateLink['url'],
            ]);
        }
        $system->refresh();
        return $system;
    }

    public function deleteSystem(System $system): System
    {
        $system->delete();
        return $system;
    }
}
