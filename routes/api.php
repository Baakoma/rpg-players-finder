<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::get('/profile/{profile}', 'ProfileController@show');
Route::put('/profile/{profile}', 'ProfileController@update');

Route::post('/events', 'EventController@create');
Route::get('/events/{event}', 'EventController@show');
Route::put('/events/{event}', 'EventController@update');
Route::post('/events/{event}/close', 'EventController@close');
Route::delete('/events/{event}', 'EventController@delete');

Route::post('/invitations', 'InvitationController@create');
Route::get('/invitations/{invitation}', 'InvitationController@show');
Route::delete('/invitations/{invitation}', 'InvitationController@delete');
Route::post('/invitations/{invitation}/accept', 'InvitationController@accept');
Route::post('/invitations/{invitation}/close', 'InvitationController@close');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});
