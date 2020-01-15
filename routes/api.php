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

Route::post('/invitation', 'InvitationController@create');
Route::get('/invitation/{invitation}', 'InvitationController@show');
Route::get('/invitation/{invitation}/accept', 'InvitationController@accept');
Route::get('/invitation/{invitation}/close', 'InvitationController@close');
Route::delete('/invitation/{invitation}', 'InvitationController@delete');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});

