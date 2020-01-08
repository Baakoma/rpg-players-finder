<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'name', 'user_id', 'max_users', 'public_access', 'is_active'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function invitation(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class,'type_event','event_id','type_id')->withTimestamps();
    }
}
