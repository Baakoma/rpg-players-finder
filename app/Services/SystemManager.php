<?php

namespace App\Services;

use App\Models\System;
use Illuminate\Support\Facades\{Auth, Log};

class SystemManager
{
    public function createSystem(array $data): System
    {
        $system = new System([
            'name' => $data['name'],
            'description' => $data['description']
        ]);

        $system->save();

        Log::info('User '.Auth::id().' created system '.$system->id);
        return $system;
    }

    public function updateSystem(System $system, array $updateData): System
    {
        $system->update([
            'name' => $updateData['name'],
            'description' => $updateData['description']
        ]);

        $system->refresh();
        Log::info('User '.Auth::id().' updated system '.$system->id);
        return $system;
    }

    public function deleteSystem(System $system): System
    {
        $system->delete();
        Log::info('User '.Auth::id().' deleted system '.$system->id);
        return $system;
    }
}
