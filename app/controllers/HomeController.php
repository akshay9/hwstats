<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function getIndex()
	{
		$bat = DB::table('bat_perfo')
				->select('player_id', 'ratting', 'created_at')
				->orderBy('ratting','Desc')
				->distinct('player_id')
				->take(5)
				->remember(1440)
				->get();

		$bowl = DB::table('bowl_perfo')
				->select('player_id', 'rating', 'created_at')
				->orderBy('rating','Desc')
				->distinct()
				->take(5)
				->remember(1440)
				->get();

		$field = DB::table('fielding')
				->select('team_id', 'fielding', 'created_at')
				->orderBy('fielding','Desc')
				->distinct()
				->take(5)
				->remember(1440)
				->get();

		return View::make('home', array('bat' => $bat, 'bowl' => $bowl, 'field' => $field, 'title' => "Home"));
		//return "Users!!";
	}

}