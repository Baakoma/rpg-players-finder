<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FriendsList extends Model
{
    private const ACCEPTED = 1;
    private const DECLINED = 2;

    protected $table = 'friends_lists';

    protected $fillable = [
        'user_id',
        'friend_id',
        'status',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function friend(): BelongsTo
    {
        return $this->belongsTo(User::class, 'friend_id');
    }

    public function isAccepted(): bool
    {
        return $this->status == self::ACCEPTED;
    }

    public function accept(): void
    {
        $this->update(['status' => self::ACCEPTED]);
    }

    public function decline(): void
    {
        $this->update(['status' => self::DECLINED]);
    }
}
