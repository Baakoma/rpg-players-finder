<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\{BelongsToMany, hasMany};

class Profile extends Model
{
    protected $fillable = ['name',
        'birth_date',
        'description'
    ];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class);
    }

    public function profileSystem(): hasMany
    {
        return $this->hasMany(ProfileSystem::class);
    }
}
