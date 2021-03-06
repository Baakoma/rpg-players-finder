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
        'name', 'owner_id', 'max_users', 'public_access', 'is_active', 'type_id', 'system_id', 'language_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'public_access' => 'boolean',
    ];

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_players', 'event_id', 'player_id');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class, 'id');
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function closeEvent(): void
    {
        $this->update(['is_active' => 0]);
    }

    public function canAccess(User $user): bool
    {
        return ($this->max_users) - 1 > $this->players()->count() && !$this->playerExist($user);
    }

    public function playerExist(string $user): bool
    {
        return $this->players->contains($user);
    }
}
