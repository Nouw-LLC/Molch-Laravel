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
//Gets the messages and sends the messages
Route::get('messages', 'FeedController@fetchFeedMsgs');
Route::post('messages', 'FeedController@sendFeedMsgs');
//All chat related things
Route::get('chats/create/{id}', 'ChatController@store');
Route::get('chat/{id}', 'ChatController@show')->name('chat');
//All user management things
Route::get('profile/{id}', 'UserController@index')->name('profile');
//All chat related things
Route::get('chat/create/{id}', 'ChatController@store');
Route::get('chat/{id}', 'ChatController@show')->name('chat');
//Settings
Route::get('settings/home', 'SettingsController@index');
Route::get('settings/avatar', 'SettingsController@avatar');
Route::post('settings/avatar/', 'SettingsController@avatar');
Route::get('settings/username', 'SettingsController@index');
Route::get('settings/email', 'SettingsController@index');
Route::get('settings/password', 'SettingsController@index');
Route::get('settings/status', 'SettingsController@index');
Route::get('settings/bio', 'SettingsController@index');
