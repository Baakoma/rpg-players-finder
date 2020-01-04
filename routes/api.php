<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('logout', 'AuthController@logout');
});

Route::get('/event/{id}', 'EventController@showEvent');
//Route::put('/event/{id}/update', 'EventController@update');
