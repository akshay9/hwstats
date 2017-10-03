<?php

class MatchController extends BaseController {

	public function showMatch($id){
		$match = Cache::remember('match_'.$id, 2, function() use ($id){
			return Match::where('match_id','=',$id)->get();
			});
		$fielding = Cache::remember('fielding_'.$id, 2, function() use ($id){
			return Fielding::where('match_id','=',$id)->get();
			});


		$bat = Cache::remember('bat_'.$id, 2, function() use ($id){
			return Bat::whereRaw('match_id = ?', array($id))->get();
		});
		$bowl = Cache::remember('bowl_'.$id, 2, function() use ($id){
			return Bowl::whereRaw('match_id = ?', array($id))->get();
		});

		//return var_dump($match);
		return View::make('match', array('match' => $match[0], 'bats1' => $bat, 'bowl1' => $bowl, 'fielding' => $fielding, 'title' => "Match"));
	}

	public function showTeam($id){
		/*
		$fielding = Cache::remember('fielding_'.$id, 2, function() use ($id){
			return Fielding::where('match_id','=',$id)->get();
			});

		*/

		$bat = DB::table('players')
				->join('bat_perfo', 'players.player_id', '=', 'bat_perfo.player_id')
				->join('matches', 'bat_perfo.match_id', '=', 'matches.match_id')
				->select('players.player_id', 'players.name', 'players.age', 'players.SI', 'players.bat_type', 'players.experience', 'players.form', 'players.fitness', 'players.updated_at', 'bat_perfo.team_id', 'bat_perfo.runs', 'bat_perfo.balls', 'bat_perfo.6s', 'bat_perfo.4s', 'bat_perfo.ratting', 'bat_perfo.created_at', 'matches.pitch')
				->where('bat_perfo.team_id', '=', $id)
				->orderBy('players.SI', 'DESC')
				->orderBy('matches.pitch')
				->orderBy('bat_perfo.created_at', 'desc')
				->remember(10)
				->get();

		//return var_dump($bat);
		return View::make('teambat', array('bat' => $bat,'id' => $id, 'title' => "Team"));

	}

	public function showBowl($id){
		/*
		SELECT players.player_id, players.name, players.age, players.SI, players.bat_type, players.experience, players.form, players.fitness,  players.updated_at, bat_perfo.team_id, bat_perfo.runs, bat_perfo.6s, bat_perfo.4s, bat_perfo.ratting, bat_perfo.created_at , matches.pitch
FROM players
INNER JOIN `bat_perfo` ON `players`.`player_id`=`bat_perfo`.`player_id`
INNER JOIN `matches` ON `bat_perfo`.`match_id`=`matches`.`match_id` 
WHERE `bat_perfo`.`team_id` = '165' 
ORDER BY bat_perfo.ratting, `players`.`player_id`, `matches`.`pitch`, `bat_perfo`.`created_at` DESC
		*/
		$bowl = DB::table('players')
				->join('bowl_perfo', 'players.player_id', '=', 'bowl_perfo.player_id')
				->join('matches', 'bowl_perfo.match_id', '=', 'matches.match_id')
				->select('players.player_id', 'players.name', 'players.age', 'players.SI', 'players.bowl_type', 'players.experience', 'players.form', 'players.fitness', 'players.updated_at', 'bowl_perfo.team_id', 'bowl_perfo.runs', 'bowl_perfo.balls', 'bowl_perfo.rating', 'bowl_perfo.created_at', 'matches.pitch')
				->where('bowl_perfo.team_id', '=', $id)
				->orderBy('players.SI', 'DESC')
				->orderBy('players.player_id')
				->orderBy('matches.pitch')
				->orderBy('bowl_perfo.created_at', 'desc')
				->remember(60)
				->get();

		//return var_dump($bat);
		return View::make('teambowl', array('bowl' => $bowl,'id' => $id, 'title' => "Team"));

	}

	public function showIndex($id)
	{
		$matches = DB::table('matches')
					->where('team1_id', '=', $id)
					->orWhere('team2_id', '=', $id)
					->orderBy('id', 'desc')
					->take(5)
					->remember(60)
					->get();

		$field = DB::table('fielding')
					->where('team_id', '=', $id)
					->orderBy('id', 'desc')
					->take(5)
					->remember(60)
					->get();

		//return $matches;
		return View::make('team', array('field' => $field, 'matches' => $matches,'id' => $id, 'title' => "Team"));
	}

}

?>

