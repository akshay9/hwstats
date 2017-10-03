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
/*
Route::get('/', function()
{
	return View::make('home');
});*/

Route::get('/', 'HomeController@getIndex');
/*
Route::get('users', function()
{
    return 'Users!';
});

*/
/*
Route::get('users', function()
{
	if (!Cache::has('users_cache'))
	{
    $users = User::all();
    Cache::put('users_cache', $users, 1);
	}
	else
	{
		$users = Cache::get('users_cache');
	}
    return View::make('users')->with('users', $users);
});
*/

Route::get('demo/{id}', 'DemoController@showProfile');

Route::get('form', 'FormController@showForm');


Route::post('formpost', 'FormController@processInput');

Route::controller('users', 'UsersController');
Route::post('users/register', 'UsersController@postRegister');
Route::post('users/login', 'UsersController@postLogin');
Route::get('users/logout', 'UsersController@getLogout');

Route::controller('home', 'HomeController');

Route::get('match/{id}', 'MatchController@showMatch');
Route::get('team/bat/{id}', 'MatchController@showTeam');
Route::get('team/bowl/{id}', 'MatchController@showBowl');
Route::get('team/{id}', 'MatchController@showIndex');
Route::get('player/{id}', 'PlayerController@showPlayer');
Route::get('auctionapi/{id}', 'AuctionController@getAuctionapi');
//Route::controller('search/', 'SearchController');
Route::post('search/', 'SearchController@showIndex');
Route::get('search/', 'SearchController@showIndex');
Route::controller('auction', 'AuctionController');
Route::controller('stars', 'StarsController');
Route::controller('bids', 'BidController');
Route::controller('scripts', 'ScriptController');