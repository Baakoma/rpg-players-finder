<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileSystem extends Model
{
    protected $table = 'profile_system';
    protected $fillable = ['lore_knowledge_rating',
        'mechanic_knowledge_rating',
        'roleplay_rating',
        'experience'
    ];

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }
}
