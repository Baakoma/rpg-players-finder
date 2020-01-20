<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JoinRequest extends Model
{
    protected $table = 'join_requests';

    protected $fillable = [
        'player_id', 'event_id', 'accepted', 'close',
    ];

    protected $casts = [
        'accepted' => 'boolean',
        'close' => 'boolean',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function closeJoinRequest(): void
    {
        $this->update(['close' => 1]);
    }

    public function acceptJoinRequest(): void
    {
        $this->update(['accepted' => 1]);
    }
}
