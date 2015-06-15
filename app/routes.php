<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@showWelcome');
Route::get('/upload', 'UploadController@showWelcome');
Route::post('/upload', 'UploadController@submit');
Route::controller('/auth', 'AuthController');
Route::get('/video', 'VideoController@showVideo');
Route::post('/ajax', 'AjaxThumbController@loadThumb');
Route::get('/admin', 'AdminController@showWelcome');
Route::post('/admin', 'AdminController@remove');
