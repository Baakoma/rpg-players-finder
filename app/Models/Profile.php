<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasOne, BelongsTo};

class Profile extends Model
{

    protected $fillable = ['name', 'birth_date', 'sex', 'description'];

    protected $table = 'profiles';

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class)
            ->withPivot('lore_knowledge_rating', 'mechanic_knowledge_rating', 'roleplay_rating', 'experience');
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
