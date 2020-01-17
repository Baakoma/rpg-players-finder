<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name', 'owner_id', 'max_users', 'public_access', 'is_active', 'type_id'
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_players', 'event_id', 'player_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function invitation(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function close(): void
    {
        $this->update(['is_active' => 0]);
    }

    public function canAccess(): bool
    {
        return ($this->max_users) - 1 > $this->players()->count();
    }
}
