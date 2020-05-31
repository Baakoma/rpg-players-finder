<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, HasOne};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    private const ROLE_ADMIN = 1;
    private const ROLE_USER = 0;

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function isAdmin(): bool
    {
        return self::ROLE_ADMIN === 'role';
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_players', 'player_id', 'event_id');
    }

    public function ownerEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'owner_id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }
}
