<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Link extends Model
{
    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }
}
