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
Route::get('/', function () {
	    return view('welcome');
	});

// Authenticated Routes
Route::group(['middleware' => 'auth'], function () {
	Route::get('/login', 'taskController@login');
	Route::get('/task', 'taskController@showTask');
	Route::get('/newtasks', function () {
	    return view('newtasks');
	});
	Route::post('/task', 'taskController@addTask');
	Route::post('/task/update', 'taskController@updateStatus');
	Route::delete('/task/delete', 'taskController@deleteTast');
	Route::delete('/assignedtask/delete', 'taskController@deleteAssignedTast');
	Route::get('/register', 'taskController@register');
	Route::post('/assigntask/assignedtask', 'taskController@assignTask');
	Route::get('/assigntask', 'taskController@showTaskToAssign');
	Route::get('/assigntask/update', 'taskController@getTaskId');
	//Route::get('/home', 'taskController@homeRefresh');

 });

	Route::auth();

	Route::get('/home', 'taskController@homeRefresh');
