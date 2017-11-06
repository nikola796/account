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

/*Route::get('/', function(){
    dd(app('config')['database']['default']);
});*/
Route::get('/', 'WelcomeController@index');


Route::get('home', 'HomeController@index');

Route::resource('articles', 'ArticlesController');

Route::resource('funds', 'FundsController');

Route::resource('tags', 'TagsController');

Route::resource('categories', 'CategoriesController');

Route::resource('accounts', 'AccountsController');

Route::resource('groups', 'GroupsController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


