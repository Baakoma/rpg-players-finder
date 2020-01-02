<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rpgsystem_user extends Model
{
    protected $table='rpgsystem_user';

    public function rpgsystems(){
        return $this->belongsTo(Rpgsystem::class);
    }
}
