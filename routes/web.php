<?php

use App\Channel;

Route::get('/', 'SnippetsController@index')->name('home');
Route::get('/snippets/create', 'SnippetsController@create')->middleware('auth');
Route::get('/snippets/{snippet}', 'SnippetsController@show');
Route::get('/snippets', 'SnippetsController@user')->middleware('auth');
Route::post('/snippets', 'SnippetsController@store')->middleware('auth');
Route::get('/snippets/{snippet}/fork', 'SnippetsController@create')->middleware('auth');
Route::get('/snippets/{snippet}/edit', 'SnippetsController@edit')->middleware('auth');
Route::patch('/snippets/{snippet}', 'SnippetsController@update')->middleware('auth');

//Auth Routes
Auth::routes();

//Likes System Routes
Route::get('/like/{snippet}', 'SnippetsController@check');
Route::get('/like/{snippet}/count', 'SnippetsController@likesCount');
Route::post('/like/{snippet}', 'SnippetsController@like')->middleware('auth');
