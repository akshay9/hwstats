<?php

class PlayerController extends BaseController {

	public function showPlayer($id)
	{
		$player = DB::table('players')
					->where('player_id', '=', $id)
					->remember(60)
					->first();

		$bat_perfo = DB::table('bat_perfo')
					->where('player_id', '=', $id)
					->take(10)
					->remember(60);

		$bowl_perfo = DB::table('bowl_perfo')
					->where('player_id', '=', $id)
					->take(10)
					->remember(60);

		//$cont = $bowl_perfo->orderBy('team_id')->get();

		//return $player;
		return View::make('player', array('player' => $player, 'bat' => $bat_perfo, 'bowl' => $bowl_perfo, 'title' => 'Player'));
	}

}