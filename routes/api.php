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
Route::put('/event/{event}/close', 'EventController@close');
Route::delete('/event/{event}', 'EventController@delete');

Route::post('/event/{event}/invite', 'InvitationController@create');

Route::get('/event/{event}/invite/{invite}', 'InvitationController@show');
Route::put('/event/{event}/invite/{invite}/accept', 'InvitationController@accept');
Route::put('/event/{event}/invite/{invite}/close', 'InvitationController@close');
Route::delete('/event/{event}/invite/{invite}', 'InvitationController@delete');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});

