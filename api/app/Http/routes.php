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

Route::get('/', 'WelcomeController@index');

Route::post('/login',"CommonController@login");

Route::get('/checkuser', ['middleware'=>'auth','uses'=>'CommonController@checkuser']);

Route::get('/modules', ['middleware'=>'auth','uses'=>'CommonController@modules']);

Route::get('/menus', ['middleware'=>'auth','uses'=>'CommonController@menus']);

Route::get('/offices', ['middleware'=>'auth','uses'=>'OfficeController@offices']);

Route::post('/save_office', ['middleware'=>'auth','uses'=>'OfficeController@save_office']);

Route::post('/activate_office', ['middleware'=>'auth','uses'=>'OfficeController@activate_office']);

Route::post('/deactivate_office', ['middleware'=>'auth','uses'=>'OfficeController@deactivate_office']);