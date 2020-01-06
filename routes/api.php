<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::post('/event/create', 'EventController@createEvent');
Route::get('/event/{id}', 'EventController@showEvent');
Route::get('/event/{id}/delete', 'EventController@deleteEvent');
Route::post('/event/{id}/update', 'EventController@updateEvent');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});
