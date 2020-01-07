<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::post('/event/create', 'EventController@createEvent');
Route::get('/event/{event}', 'EventController@showEvent');
Route::post('/event/{event}', 'EventController@updateEvent');
Route::put('/event/{event}/close', 'EventController@closeEvent');
Route::delete('/event/{event}', 'EventController@deleteEvent');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});
