<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'data_id',
        'data_type',
    ];

    private $dataTypes = [
        'App\Models\Invitation' => 'invitation',
        'App\Models\JoinRequest' => 'join-request',
        'App\Models\Message' => 'message',
    ];

    public function getDataType(): string
    {
        return $this->dataTypes[$this->data_type];
    }

    public function data(): MorphTo
    {
        return $this->morphTo();
    }
}
