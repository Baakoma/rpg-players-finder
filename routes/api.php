<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});

Route::get('/profile/{profile}', 'ProfileController@show');
Route::put('/profile/{profile}', 'ProfileController@update');

Route::post('/event', 'EventController@create');
Route::get('/event/{event}', 'EventController@show');
Route::put('/event/{event}', 'EventController@update');
Route::get('/event/{event}/close', 'EventController@close');
Route::delete('/event/{event}', 'EventController@delete');

Route::post('/invitation', 'InvitationController@create');
Route::get('/invitation/{invitation}', 'InvitationController@show');
Route::delete('/invitation/{invitation}', 'InvitationController@delete');
Route::post('/invitation/{invitation}/accept', 'InvitationController@accept');
Route::post('/invitation/{invitation}/close', 'InvitationController@close');

Route::post('/ticket/{profile}', 'TicketController@create');
Route::get('/ticket/{profile}', 'TicketController@show');
Route::put('/ticket/{profile}', 'TicketController@update');
Route::delete('/ticket/{profile}', 'TicketController@destroy');

Route::get('/search/tickets', 'SearchController@indexTickets');
