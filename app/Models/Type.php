<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = [
        'name',
        'description'
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
