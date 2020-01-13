<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invitation extends Model
{
    protected $table = 'invitations';

    protected $fillable = [
        'user_id', 'event_id', 'accepted', 'close',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
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
