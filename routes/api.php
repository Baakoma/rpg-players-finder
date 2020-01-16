<?php

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['auth.jwt']], function (): void {
    Route::post('logout', 'AuthController@logout');
});

Route::get('/profile/{profile}', 'ProfileController@show');
Route::put('/profile/{profile}', 'ProfileController@update');
