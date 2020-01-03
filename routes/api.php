<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => 'auth.jwt'], function () {
    Route::group(['middleware' => ['role']], function () {
        Route::post('admin', 'AuthController@admin');
    });
    Route::post('user', 'AuthController@user');
    Route::post('logout', 'AuthController@logout');
});
