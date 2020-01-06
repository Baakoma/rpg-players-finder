<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class System extends Model
{
    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class)->withTimestamps();
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}
