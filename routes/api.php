<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/profile/{profile}', 'ProfileController@show');
Route::put('/profile/{profile}', 'ProfileController@update');

//Route::post('/tickets/{profile}', 'TicketController@create');
Route::get('/tickets/{profile}', 'TicketController@show');
//Route::put('/tickets/{profile}', 'TicketController@update');
//Route::delete('/tickets/{profile}', 'TicketController@destroy');
