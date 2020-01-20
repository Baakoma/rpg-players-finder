<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});

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

Route::post('/systems', 'SystemController@create');
Route::get('/systems', 'SystemController@index');
Route::get('/systems/{system}', 'SystemController@show');
Route::put('/systems/{system}', 'SystemController@update');
Route::delete('/systems/{system}', 'SystemController@delete');

Route::post('/languages', 'LanguageController@create');
Route::get('/languages', 'LanguageController@index');
Route::get('/languages/{language}', 'LanguageController@show');
Route::put('/languages/{language}', 'LanguageController@update');
Route::delete('/languages/{language}', 'LanguageController@delete');

Route::post('/types', 'TypeController@create');
Route::get('/types', 'TypeController@index');
Route::get('/types/{type}', 'TypeController@show');
Route::put('/types/{type}', 'TypeController@update');
Route::delete('/types/{type}', 'TypeController@delete');

Route::post('/ticket/{profile}', 'TicketController@create');
Route::get('/ticket/{profile}', 'TicketController@show');
Route::put('/ticket/{profile}', 'TicketController@update');
Route::delete('/ticket/{profile}', 'TicketController@destroy');
