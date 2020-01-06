<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/profile/{id}', 'ProfileController@show');

Route::put('/profile/{id}', 'ProfileController@update');
