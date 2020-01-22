<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JoinRequest extends Model
{
    protected $table = 'join_requests';

    public const ACCEPT = 1;
    public const DECLINED = 2;
    public const CLOSE = 3;

    protected $fillable = [
        'player_id', 'event_id', 'message', 'status',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    public function acceptJoinRequest(): void
    {
        $this->update(['status' => self::ACCEPT]);
    }

    public function declineJoinRequest(): void
    {
        $this->update(['status' => self::DECLINED]);
    }

    public function closeJoinRequest(): void
    {
        $this->update(['status' => self::CLOSE]);
    }
}
