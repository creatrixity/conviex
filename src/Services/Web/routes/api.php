<?php

/*
|--------------------------------------------------------------------------
| Service - API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Prefix: /api/web
Route::group(['prefix' => 'web'], function() {

    // The controllers live in src/Services/Web/Http/Controllers
    // Route::get('/', 'UserController@index');

    Route::get('/', function() {
        return response()->json(['path' => '/api/web']);
    });
    
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

});