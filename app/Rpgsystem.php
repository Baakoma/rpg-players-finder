<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpgsystem extends Model
{
    public function users(){
        return $this->belongsToMany(User::class);
    }
}
