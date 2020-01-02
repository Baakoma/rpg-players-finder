<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function languages(){
        return $this->belongsToMany(Language::class);
    }

    public function rpgsystems(){
        return $this->belongsToMany(Rpgsystem::class);
    }

    public function rpgsystem_user(){
        return $this->hasMany(Rpgsystem_user::class);
    }

    /*public function insert(Request $request)
    {
        $flight = new Flight;

        $flight->name = $request->name;

        $flight->save();
    }*/
}
