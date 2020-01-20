<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    public const ROLE_ADMIN = 1;
    public const ROLE_USER = 0;

    protected $fillable = [
        'role', 'name', 'email', 'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class, 'event_players', 'player_id', 'event_id');
    }

    public function ownerEvents(): HasMany
    {
        return $this->hasMany(Event::class, 'id');
    }

    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }
}
