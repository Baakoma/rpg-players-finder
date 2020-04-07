<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $table = 'invitations';

    private const ACCEPT = 1;
    private const DECLINED = 2;
    private const CLOSE = 3;

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

    public function acceptInvitation(): void
    {
        $this->update(['status' => self::ACCEPT]);
    }

    public function declineInvitation(): void
    {
        $this->update(['status' => self::DECLINED]);
    }

    public function closeInvitation(): void
    {
        $this->update(['status' => self::CLOSE]);
    }
}
