<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id){
        return new UserResource(User::query()->findOrFail($id));
    }
}

