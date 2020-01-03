<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile/{id}', 'ProfileController@show');
Route::get('/profile/{id}/update', 'ProfileController@update');
