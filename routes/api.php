<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/** Authentication */
Route::post('/register', 'RegisterController@register');
Route::post('/login', 'LoginController@login');
Route::post('/logout', 'LogoutController@logout');
Route::get('/user', 'UserController@user');

/** Everyone */
Route::get('/filters', 'SearchController@searchTicket');
Route::get('/events', 'SearchController@searchEvent');

Route::get('/systems', 'SystemController@index');
Route::get('/languages', 'LanguageController@index');
Route::get('/types', 'TypeController@index');

Route::get('/notifications','NotificationController@index');

/** Only users+ */
Route::middleware('auth:sanctum')->group(function (): void {
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
    Route::post('/invitations/{invitation}/decline', 'InvitationController@decline');
    Route::post('/invitations/{invitation}/close', 'InvitationController@close');

    Route::post('/join-request', 'JoinRequestController@create');
    Route::get('/join-request/{joinRequest}', 'JoinRequestController@show');
    Route::delete('/join-request/{joinRequest}', 'JoinRequestController@delete');
    Route::post('/join-request/{joinRequest}/accept', 'JoinRequestController@accept');
    Route::post('/join-request/{joinRequest}/decline', 'JoinRequestController@decline');
    Route::post('/join-request/{joinRequest}/close', 'JoinRequestController@close');
});

/** Only admin */
Route::group(['middleware' => ['auth:sanctum', 'is.admin']], function (): void {
    Route::post('/systems', 'SystemController@create');
    Route::get('/systems/{system}', 'SystemController@show');
    Route::put('/systems/{system}', 'SystemController@update');
    Route::delete('/systems/{system}', 'SystemController@delete');

    Route::post('/languages', 'LanguageController@create');
    Route::get('/languages/{language}', 'LanguageController@show');
    Route::put('/languages/{language}', 'LanguageController@update');
    Route::delete('/languages/{language}', 'LanguageController@delete');

    Route::post('/types', 'TypeController@create');
    Route::get('/types/{type}', 'TypeController@show');
    Route::put('/types/{type}', 'TypeController@update');
    Route::delete('/types/{type}', 'TypeController@delete');
});
