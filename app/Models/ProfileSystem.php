<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProfileSystem extends Pivot
{
    protected $table = 'profile_system';

    protected $fillable = [
        'system_id',
        'lore_knowledge_rating',
        'mechanic_knowledge_rating',
        'roleplay_rating',
        'experience'
    ];

    public $incrementing = true;
}
