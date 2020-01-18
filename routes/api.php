<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/profile/{profile}', 'ProfileController@show');
Route::put('/profile/{profile}', 'ProfileController@update');

Route::post('/ticket/{profile}', 'TicketController@create');
Route::get('/ticket/{profile}', 'TicketController@show');
Route::put('/ticket/{profile}', 'TicketController@update');
Route::delete('/ticket/{profile}', 'TicketController@destroy');
