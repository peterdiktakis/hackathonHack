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

Route::get('/', 'PagesController@landing');

Route::get('home', 'HomeController@index');
Route::get('about', 'PagesController@about');
Route::get('activity', 'PagesController@activity');

Route::get('suggestions', 'ApiController@suggestions');
Route::get('date', 'SessionController@date');
Route::get('location', 'SessionController@location');
Route::get('hotel', 'ApiController@hotel');
Route::get('activities', 'ApiController@activities');
Route::get('yelp', 'ApiController@yelp');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('testNoham', 'PagesController@testNoham');

Route::get('maps', 'PagesController@testMaps');
