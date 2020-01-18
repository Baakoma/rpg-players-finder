<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $table = 'invitations';

    protected $fillable = [
        'player_id', 'event_id', 'accepted', 'close',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function closeInvitation(): void
    {
        $this->update(['close' => 1]);
    }

    public function acceptInvitation(): void
    {
        $this->update(['accepted' => 1]);
    }
}
