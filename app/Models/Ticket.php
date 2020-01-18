<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ticket extends Model
{
    protected $fillable = ['camera', 'description'];

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class);
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }
}
