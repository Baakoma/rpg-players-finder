<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Profile extends Model
{
    protected $fillable = ['name', 'birth_date', 'description'];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class)
            ->withPivot('lore_knowledge_rating', 'mechanic_knowledge_rating', 'roleplay_rating', 'experience');
    }
}
