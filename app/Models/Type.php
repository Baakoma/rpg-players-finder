<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    protected $table = 'types';

    protected $fillable = [
        'name', 'description'
    ];

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class,'type_event','type_id','event_id');
    }
}
