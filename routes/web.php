<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Gets the messages end sends the messages
Route::get('messages', 'FeedController@fetchFeedMsgs');
Route::post('messages', 'FeedController@sendFeedMsgs');
//All chat related things
Route::get('chats/create/{id}', 'ChatController@store');
Route::get('chat/{id}', 'ChatController@show')->name('chat');