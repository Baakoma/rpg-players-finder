<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Rpgsystem_user;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id){
        return new UserResource(User::query()->findOrFail($id));
        //return new Rpgsystem_user(Rpgsystem_user::query()->findOrFail($id));
    }
}

