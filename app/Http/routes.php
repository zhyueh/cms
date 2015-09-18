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


Route::controller('auth', 'Auth\AuthController');
Route::controller('password', 'Auth\PasswordController');
Route::controller('index', 'IndexController');
Route::controller('header', 'HeaderController');
Route::controller('entrance', 'EntranceController');
Route::controller('ad', 'AdvertisementController');
Route::controller('bulletin', 'BulletinController');
Route::controller('article', 'ArticleController');

Route::get('/', 'HomeController@getIndex');
Route::get('/home', 'HomeController@getIndex');
