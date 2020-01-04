<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileSystem extends Model
{
    protected $table='profile_system';

    public function system(): BelongsTo
    {
        return $this->belongsTo(System::class);
    }
}
