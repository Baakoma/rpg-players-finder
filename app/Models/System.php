<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class System extends Model
{
    protected $table = 'systems';

    protected $fillable = [
        'name', 'description'
    ];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function syncLinks(array $updateData): void
    {
        $this->links()->delete();
        $this->links()->createMany($updateData);
    }}
