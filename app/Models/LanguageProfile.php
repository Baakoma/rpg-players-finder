<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LanguageProfile extends Model
{
    protected $table='language_profile';

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}
