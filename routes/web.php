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
//All settings related things
Route::get('settings/home', 'SettingsController@index');
Route::get('settings/avatar', 'SettingsController@avatar');
Route::post('settings/avatar/', 'SettingsController@avatar');
Route::get('settings/username', 'SettingsController@username');
Route::post('settings/username', 'SettingsController@username');
Route::get('settings/email', 'SettingsController@email');
Route::post('settings/email', 'SettingsController@email');
Route::get('settings/password', 'SettingsController@password');
Route::post('settings/password', 'SettingsController@password');
Route::get('settings/status', 'SettingsController@status');
Route::post('settings/status', 'SettingsController@status');
Route::get('settings/bio', 'SettingsController@bio');
Route::post('settings/bio', 'SettingsController@bio');
//All admin related things
Route::post('post/report', 'FeedController@report');
Route::group(['middleware' => ['role:Admin|Moderator']], function () {
    Route::get('staff/dashboard', 'StaffController@index');
    Route::post('staff/task', 'TaskController@createTask');
    Route::get('staff/task/fetch', 'TaskController@fetch');
    Route::post('staff/task/delete', 'TaskController@delete');
});
