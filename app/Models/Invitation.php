<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Invitation extends Model
{
    protected $table = 'invitations';

    protected $fillable = [
        'user_id', 'event_id', 'accepted', 'close',
    ];

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function events(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    }

    public function close(): void
    {
        $this->update(['close' => 1]);
    }

    public function accept(): void
    {
        $this->update(['accepted' => 1]);
    }
}
