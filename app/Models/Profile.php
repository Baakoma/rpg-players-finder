<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasOne};

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'name',
        'birth_date',
        'sex',
        'description'
    ];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class)
            ->withPivot('system_id', 'lore_knowledge_rating', 'mechanic_knowledge_rating', 'roleplay_rating', 'experience');
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
