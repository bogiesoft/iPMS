<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', [
	'uses' => 'HomeController@index',
	'as'   => 'index',
	'middleware' => ['guest']
]);
Route::get('/dashboard', [
	'uses' => 'HomeController@dashboard',
	'as'   => 'dashboard'
]);
Route::get('/calendar', 'HomeController@calendar');
Route::get('/statistics', 'HomeController@statistics');
Route::get('/manage/{item}', 'HomeController@manage');
Route::get('/approve/{item}', 'HomeController@approve');

Route::get('/auth/register', [
	'uses' => 'AuthController@getRegister',
	'as'   => 'auth.register',
	'middleware' => ['guest']
]);
Route::post('/auth/register', [
	'uses' => 'AuthController@postRegister',
	'middleware' => ['guest']
]);
Route::get('/auth/login', [
	'uses' => 'AuthController@getLogin',
	'as'   => 'auth.login',
	'middleware' => ['guest']
]);
Route::post('/auth/login', [
	'uses' => 'AuthController@postLogin',
	'middleware' => ['guest']
]);
Route::get('/auth/logout', [
	'uses' => 'AuthController@logOut',
	'as'   => 'auth.logout'
]);

Route::resource('projects', 'ProjectController');

Route::match(['get', 'post'], '/grid_/{tbl}', "DhtmlxController@grid");
Route::match(['get', 'post'], '/gantt_/{pid}', "DhtmlxController@gantt");
Route::match(['get', 'post'], '/schedule_/{pid}', "DhtmlxController@schedule");

Route::auth();