<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        'message',
    ];

    public function notification(): MorphOne
    {
        return $this->morphOne('App\Models\Notification', 'data');
    }
}
