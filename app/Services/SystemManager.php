<?php

namespace App\Services;

use App\Models\System;

class SystemManager
{
    public function createSystem(array $data): System
    {
        $system = new System([
            'name' => $data['name'],
            'description' => $data['description']
        ]);
        $system->save();
        $system->links()->createMany($data['links']);
        return $system;
    }

    public function updateSystem(System $system, array $updateData): System
    {
        $system->update([
            'name' => $updateData['name'],
            'description' => $updateData['description']
        ]);
        $system->syncLinks($updateData['links']);
        $system->refresh();
        return $system;
    }

    public function deleteSystem(System $system): System
    {
        $system->delete();
        return $system;
    }
}
