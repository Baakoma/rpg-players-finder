<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::post('/event', 'EventController@create');
Route::get('/event/{event}', 'EventController@show');
Route::put('/event/{event}', 'EventController@update');
Route::get('/event/{event}/close', 'EventController@close');
Route::delete('/event/{event}', 'EventController@delete');

Route::post('/invite', 'InvitationController@create');
Route::get('/invite/{invitation}', 'InvitationController@show');
Route::get('/invite/{invitation}/accept', 'InvitationController@accept');
Route::get('/invite/{invitation}/close', 'InvitationController@close');
Route::delete('/invite/{invitation}', 'InvitationController@delete');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});

