<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Auth::routes(['verify' => true]);

Route::post('login', 'AuthController@login');
Route::post('register', 'AuthController@register');

Route::group(['middleware' => ['auth.jwt','verified']], function () {
    Route::post('logout', 'AuthController@logout');
});
