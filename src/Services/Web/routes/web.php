<?php

/*
|--------------------------------------------------------------------------
| Service - Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for this service.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['prefix' => 'web'], function() {

    // The controllers live in src/Services/Web/Http/Controllers
    // Route::get('/', 'UserController@index');

    Route::get('/', function() {
        return view('web::welcome');
    });

});

Route::group(['middleware' => ['web']], function () {

    Route::get('/users', 'UserController@index')
        ->name('users')
        ->middleware('auth');

    Route::get('/{username}', 'UserController@show')
        ->name('profile')
        ->middleware('auth');

    Route::get('/conversations', 'ConversationController@index')
          ->name('conversations')
          ->middleware('auth');

    Route::get('/conversations/{id}', 'ConversationController@show')
          ->where('id', '[0-9]+')
          ->name('conversation')
          ->middleware('auth');

    Route::get('/message/{id}', 'MessageController@show')
          ->where('id', '[0-9]+')
          ->name('message')
          ->middleware('auth');

    Route::post('/message', 'MessageController@store')
            ->name('message.create')
            ->middleware('auth');

});
