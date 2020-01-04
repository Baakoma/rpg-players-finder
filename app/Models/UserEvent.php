<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserEvent extends Model
{
    protected $table = 'user_event';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }
}
