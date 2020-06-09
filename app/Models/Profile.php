<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany, HasOne};

class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'birth_date',
        'sex',
        'discord',
        'camera',
        'description',
    ];

    protected $casts = [
        'camera' => 'boolean',
    ];

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(Language::class);
    }

    public function systems(): BelongsToMany
    {
        return $this->belongsToMany(System::class);
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
