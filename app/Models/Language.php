<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Language extends Model
{
    protected $table = 'languages';

    protected $fillable = ['name'];

    public function profiles(): BelongsToMany
    {
        return $this->belongsToMany(Profile::class);
    }
}
