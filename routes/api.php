<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

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

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});
