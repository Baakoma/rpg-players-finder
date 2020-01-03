<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public $publicAccess=true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
