<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Ticket extends Model
{
    protected $fillable = ['profile_id', 'system_id', 'camera', 'description'];

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
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
