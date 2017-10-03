<?php

class SearchController extends BaseController
{
	
	public function showIndex($page = '1')
	{
		$search = Input::get('search');

		$players = DB::table('players')
					->where('name','LIKE','%'.$search.'%')
					->orWhere('player_id','LIKE','%'.$search.'%')
					->paginate(10);

		$teams = DB::table('teams')
					->where('name','LIKE','%'.$search.'%')
					->orWhere('team_id','LIKE','%'.$search.'%')
					->paginate(10);

		return View::make('search', array('players' => $players, 'teams' => $teams, 'title' => 'Search' ));
	}

	public function getIndex()
	{
		return "ok";
	}
}