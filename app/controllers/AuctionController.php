<?php

class AuctionController extends BaseController {

	public function getIndex()
	{
		//var_dump(Input::get('age'));
		
		$sort_by = Input::get('sort_by') !== NULL ? Input::get('sort_by') : 'time' ;
		$age = Input::get('age') !== NULL ? Input::get('age') : 35 ;
		$bat_style = Input::get('bat_style') !== NULL ? Input::get('bat_style'):0 ;
		$bowl_style = Input::get('bowl_style') !== NULL ? Input::get('bowl_style'):0 ;
		$xp = Input::get('xp') !== NULL ? Input::get('xp'):0 ;
		$form = Input::get('form') !== NULL ? Input::get('form'):0 ;
		$fitness = Input::get('fitness') !== NULL ? Input::get('fitness'):0 ;
		$maxPrice = (Input::get('max_price') !== NULL AND Input::get('max_price') != 0) ? Input::get('max_price'):99999999 ;
		$fielding = Input::get('fielding') !== NULL ? Input::get('fielding'):0 ;
		$wicketkeeping = Input::get('wicketkeeping') !== NULL ? Input::get('wicketkeeping'):0 ;
		$bat_spin = Input::get('bat_spin') !== NULL ? Input::get('bat_spin'):0 ;
		$bat_seam = Input::get('bat_seam') !== NULL ? Input::get('bat_seam'):0 ;
		$bat_stars = Input::get('bat_stars') !== NULL ? Input::get('bat_stars'):0 ;
		$bowl_main = Input::get('bowl_main') !== NULL ? Input::get('bowl_main'):0 ;
		$bowl_var = Input::get('bowl_var') !== NULL ? Input::get('bowl_var'):0 ;
		$bowl_stars = Input::get('bowl_stars') !== NULL ? Input::get('bowl_stars'):0 ;
		$u20 =  Input::get('u20') !== NULL ? Input::get('u20'):0 ;

		//var_dump($age);
		$validator = Validator::make(
			array(
				'sort_by' => $sort_by,
				'age' => $age,
				'bat_style' => $bat_style,
				'bowl_style' => $bowl_style,
				'xp' => $xp, 
				'form' => $form,
				'fitness' => $fitness,
				'maxPrice' => $maxPrice,
				'fielding' => $fielding,
				'wicketkeeping' => $wicketkeeping,
				'bat_seam' => $bat_seam,
				'bat_spin' => $bat_spin,
				'bat_stars' => $bat_stars,
				'bowl_main' => $bowl_main,
				'bowl_var' => $bowl_var,
				'bowl_stars' => $bowl_stars,
				),
			array(
				'sort_by' => 'in:time,price,age,si,salary,experience,fielding,wicket,bat_seam,bat_spin,bowl_var,bowl_main',
				'age' => 'integer|min:17|max:35',
				'bat_style' => 'in:0,1,2',
				'bowl_style' => 'in:0,1,2',
				'xp' => 'integer|min:0|max:20', 
				'form' => 'in:0,1,2,3,4,5,6',
				'fitness' => 'in:0,1,2,3,4,5,6',
				'maxPrice' => 'integer|min:0',
				'fielding' => 'integer|min:0|max:20',
				'wicketkeeping' => 'integer|min:0|max:20',
				'bat_seam' => 'integer|min:0|max:20',
				'bat_spin' => 'integer|min:0|max:20',
				'bat_stars' => 'integer|min:0|max:20',
				'bowl_main' => 'integer|min:0|max:20',
				'bowl_var' => 'integer|min:0|max:20',
				'bowl_stars' => 'integer|min:0|max:20',
				)
			);

		if ($validator->fails())
    	{
    		var_dump($bowl_var);
   		    return Redirect::to('/index')->withErrors($validator);
    	}

    	switch ($bat_style) {
    		case '0':
    			$bat_query = '%%';
    			break;
    		case '1':
    			$bat_query = '%Right%';
    			break;
    		case '2':
    			$bat_query = '%Left%';
    			break;
    		default:
    			$bat_query = '%%';
    			break;
    	}

    	$u20time = 1392834600; //date_format(date_create('2014-02-20'), 'U');
    	$ayear = 6048000; // 70*24*60*60 ;
    	switch ($u20) {
    		case '0':
    			$u20tm = 1999999999;
    			break;
    		case '6':
    			$u20tm = 1400 - round((($u20time + ($ayear * ($u20 - 5)) - time()) / (24*60*60)) + 0.5);
    			break;
    		case '7':
    			$u20tm = 1400 - round((($u20time + ($ayear * ($u20 - 5)) - time()) / (24*60*60)) + 0.5);
    			break;
    		case '8':
    			$u20tm = 1400 - round((($u20time + ($ayear * ($u20 - 5)) - time()) / (24*60*60)) + 0.5);
    			break;
    		case '9':
    			$u20tm = 1400 - round((($u20time + ($ayear * ($u20 - 5)) - time()) / (24*60*60)) + 0.5);
    			break;
    		default:
    			$u20tm = 1999999999;
    			break;
    	}
    	$ageFinal = (($age * 70) < $u20tm) ? ($age * 70) : $u20tm;

		$auctions = DB::table('auction')
						->join('players', 'auction.player_id', '=', 'players.player_id')
						->join('teams', 'auction.team_id', '=', 'teams.team_id')
						->select('auction.player_id',
								 'auction.team_id', 
								 'auction.age', 
								 'auction.experience', 
								 'auction.form', 
								 'auction.fitness', 
								 'auction.si', 
								 'auction.salary', 
								 'auction.price', 
								 'auction.time', 
								 'auction.fielding', 
								 'auction.wicket', 
								 'auction.bat_seam', 
								 'auction.bat_spin', 
								 'auction.bat_stars', 
								 'auction.bowl_main', 
								 'auction.bowl_var', 
								 'auction.bowl_stars', 
								 'teams.name AS teamname',
								 'players.bat_type',
								 'players.bowl_type',
								 'players.name AS playername')
						->where('auction.time', '>' , time())
						->where('auction.age', '<=',$ageFinal)
						->where('auction.price', '<=',$maxPrice)
						->where('auction.experience', '>=', $xp)
						->where('auction.form', '>=', $form + 1)
						->where('auction.fitness', '>=', $fitness + 1)
						->where('auction.fielding', '>=', $fielding)
						->where('auction.wicket', '>=', $wicketkeeping)
						->where('auction.bat_seam', '>=', $bat_seam)
						->where('auction.bat_spin', '>=', $bat_spin)
						->where('auction.bat_stars', '>=', $bat_stars)
						->where('auction.bowl_main', '>=', $bowl_main)
						->where('auction.bowl_var', '>=', $bowl_var)
						->where('auction.bowl_stars', '>=', $bowl_stars)
						->where('players.bat_type', 'LIKE', $bat_query)
						->where(function($query) use($bowl_style) {
							if ($bowl_style == '1') {
								$query->where('players.bowl_type', 'NOT LIKE', '%medium%')
									  ->where('players.bowl_type', 'NOT LIKE', '%fast%');
							} elseif($bowl_style == '2') {
								$query->where('players.bowl_type', 'LIKE', '%medium%')
									  ->orWhere('players.bowl_type', 'LIKE', '%fast%');
							} 
							
						})
						->orderBy($sort_by)
						->remember(3)
						->paginate(15);

		return View::make('auction', array('auction' => $auctions ,'title' => 'Auction'));
	}

	public function getQuote()
	{
		$sort_by = Input::get('sort_by') !== NULL ? Input::get('sort_by') : 'time' ;
		$age = Input::get('age') !== NULL ? Input::get('age') : 16 ;
		$bat_style = Input::get('bat_style') !== NULL ? Input::get('bat_style'):0 ;
		$bowl_style = Input::get('bowl_style') !== NULL ? Input::get('bowl_style'):0 ;
		$xp = Input::get('xp') !== NULL ? Input::get('xp'):-1 ;
		$si = Input::get('si') !== NULL ? Input::get('si'):0 ;
		//$form = Input::get('form') !== NULL ? Input::get('form'):0 ;
		//$fitness = Input::get('fitness') !== NULL ? Input::get('fitness'):0 ;
		//$maxPrice = (Input::get('max_price') !== NULL AND Input::get('max_price') != 0) ? Input::get('max_price'):99999999 ;
		$fielding = Input::get('fielding') !== NULL ? Input::get('fielding'):-1 ;
		$wicketkeeping = Input::get('wicketkeeping') !== NULL ? Input::get('wicketkeeping'):-1 ;
		$bat_spin = Input::get('bat_spin') !== NULL ? Input::get('bat_spin'):-1 ;
		$bat_seam = Input::get('bat_seam') !== NULL ? Input::get('bat_seam'):-1 ;
		$bowl_main = Input::get('bowl_main') !== NULL ? Input::get('bowl_main'):-1 ;
		$bowl_var = Input::get('bowl_var') !== NULL ? Input::get('bowl_var'):-1 ;

		//var_dump($age);
		$validator = Validator::make(
			array(
				'sort_by' => $sort_by,
				'age' => $age,
				'bat_style' => $bat_style,
				'bowl_style' => $bowl_style,
				'xp' => $xp, 
				'si' => $si,
				//'fitness' => $fitness,
				'fielding' => $fielding,
				'wicketkeeping' => $wicketkeeping,
				'bat_seam' => $bat_seam,
				'bat_spin' => $bat_spin,
				'bowl_main' => $bowl_main,
				'bowl_var' => $bowl_var,
				),
			array(
				'sort_by' => 'in:time,price,age,si,salary,experience,fielding,wicket,bat_seam,bat_spin,bowl_var,bowl_main',
				'age' => 'integer|min:16|max:35',
				'bat_style' => 'in:0,1,2',
				'bowl_style' => 'in:0,1,2',
				'xp' => 'integer|min:-1|max:20', 
				'si' => 'integer|min:0',
				//'fitness' => 'in:0,1,2,3,4,5,6',
				'fielding' => 'integer|min:-1|max:20',
				'wicketkeeping' => 'integer|min:-1|max:20',
				'bat_seam' => 'integer|min:-1|max:20',
				'bat_spin' => 'integer|min:-1|max:20',
				'bowl_main' => 'integer|min:-1|max:20',
				'bowl_var' => 'integer|min:-1|max:20',
				)
			);

		if ($validator->fails())
    	{
    		var_dump($bowl_var);
   		    return Redirect::to('/index')->withErrors($validator);
    	}

    	switch ($bat_style) {
    		case '0':
    			$bat_query = '%%';
    			break;
    		case '1':
    			$bat_query = '%Right%';
    			break;
    		case '2':
    			$bat_query = '%Left%';
    			break;
    		default:
    			$bat_query = '%%';
    			break;
    	}

    	$ageFinal = $age * 70 ;

		$auctions = DB::table('auction')
						->join('players', 'auction.player_id', '=', 'players.player_id')
						//->join('teams', 'auction.team_id', '=', 'teams.team_id')
						->select('auction.player_id',
								 'auction.team_id', 
								 'auction.age', 
								 'auction.experience', 
								 'auction.form', 
								 'auction.fitness', 
								 'auction.si', 
								 'auction.salary', 
								 'auction.price', 
								 'auction.time', 
								 'auction.fielding', 
								 'auction.wicket', 
								 'auction.bat_seam', 
								 'auction.bat_spin', 
								 'auction.bowl_main', 
								 'auction.bowl_var', 
								 'auction.checks', 
								 'auction.status', 
								 //'teams.name AS teamname',
								 'players.bat_type',
								 'players.bowl_type',
								 'players.name AS playername')
						->where(function($query) use ($ageFinal,$age)
							{
								if ($age != 16) {
									$query->whereBetween('auction.age', array($ageFinal - 35, $ageFinal + 35));
								}
								
							}
						)
						->where(function($query) use ($xp)
							{
								if ($xp != -1) {
									$query->whereBetween('auction.experience', array($xp - 3, $xp + 3));
								}
								
							}
						)
						->where(function($query) use ($si)
							{
								$si_add = ((20/100) * $si );
								if ($si != 0) {
									$query->whereBetween('auction.si', array($si - $si_add, $si + $si_add));
								}
								
							}
						)
						->where(function($query) use ($fielding)
							{
								if ($fielding != -1) {
									$query->whereBetween('auction.fielding', array($fielding - 2, $fielding + 2));
								}
								
							}
						)
						->where(function($query) use ($wicketkeeping)
							{
								if ($wicketkeeping != -1) {
									$query->whereBetween('auction.wicket', array($wicketkeeping - 1, $wicketkeeping + 1));
								}
								
							}
						)
						->where(function($query) use ($bat_seam)
							{
								if ($bat_seam != -1) {
									$query->whereBetween('auction.bat_seam', array($bat_seam - 1, $bat_seam + 1));
								}
								
							}
						)
						->where(function($query) use ($bat_spin)
							{
								if ($bat_spin != -1) {
									$query->whereBetween('auction.bat_spin', array($bat_spin - 1, $bat_spin + 1));
								}
								
							}
						)
						->where(function($query) use ($bowl_main)
							{
								if ($bowl_main != -1) {
									$query->whereBetween('auction.bowl_main', array($bowl_main - 1, $bowl_main + 1));
								}
								
							}
						)
						->where(function($query) use ($bowl_var)
							{
								if ($bowl_var != -1) {
									//$query->whereBetween('auction.bowl_var', array($bowl_var - 1, $bowl_var + 1));
									$query->where('auction.bowl_var', '=', $bowl_var);
								}
								
							}
						)
						->where('players.bat_type', 'LIKE', $bat_query)
						->where(function($query) use($bowl_style) {
							if ($bowl_style == '1') {
								$query->where('players.bowl_type', 'NOT LIKE', '%medium%')
									  ->where('players.bowl_type', 'NOT LIKE', '%fast%');
							} elseif($bowl_style == '2') {
								$query->where('players.bowl_type', 'LIKE', '%medium%')
									  ->orWhere('players.bowl_type', 'LIKE', '%fast%');
							} 
							
						})
						->orderBy('auction.status', 'DESC')
						->orderBy('auction.time','DESC')
						->remember(3)
						->take(20)
						->get();

		$i = 0;
		$price = 0;
		foreach($auctions as $row){
			if($row->status != 0 && $i < 10){
				$price = $price + $row->price ;
				$i++;
			} else {
				break;
			}
		}
		$divide = $i == 0 ? "1" : $i ;
		$avg_price = ($price / $divide) == 0 ? "Not Found" : number_format($price / $divide) ;

		return View::make('quote', array('auction' => $auctions , 'avg_price' => $avg_price, 'title' => 'Price Quote'));
	}

	public function getQuoteapi()
	{
		$sort_by = Input::get('sort_by') !== NULL ? Input::get('sort_by') : 'time' ;
		$age = Input::get('age') !== NULL ? Input::get('age') : 1190 ;
		$bat_style = Input::get('bat_style') !== NULL ? Input::get('bat_style'):0 ;
		$bowl_style = Input::get('bowl_style') !== NULL ? Input::get('bowl_style'):0 ;
		$xp = Input::get('xp') !== NULL ? Input::get('xp'):-1 ;
		$si = Input::get('si') !== NULL ? Input::get('si'):-1 ;
		//$form = Input::get('form') !== NULL ? Input::get('form'):0 ;
		//$fitness = Input::get('fitness') !== NULL ? Input::get('fitness'):0 ;
		//$maxPrice = (Input::get('max_price') !== NULL AND Input::get('max_price') != 0) ? Input::get('max_price'):99999999 ;
		$fielding = Input::get('fielding') !== NULL ? Input::get('fielding'):-1 ;
		$wicketkeeping = Input::get('wicketkeeping') !== NULL ? Input::get('wicketkeeping'):-1 ;
		$bat_spin = Input::get('bat_spin') !== NULL ? Input::get('bat_spin'):-1 ;
		$bat_seam = Input::get('bat_seam') !== NULL ? Input::get('bat_seam'):-1 ;
		$bowl_main = Input::get('bowl_main') !== NULL ? Input::get('bowl_main'):-1 ;
		$bowl_var = Input::get('bowl_var') !== NULL ? Input::get('bowl_var'):-1 ;

		//var_dump($age);
		$validator = Validator::make(
			array(
				'sort_by' => $sort_by,
				'age' => $age,
				'bat_style' => $bat_style,
				'bowl_style' => $bowl_style,
				'xp' => $xp, 
				'si' => $si,
				//'fitness' => $fitness,
				'fielding' => $fielding,
				'wicketkeeping' => $wicketkeeping,
				'bat_seam' => $bat_seam,
				'bat_spin' => $bat_spin,
				'bowl_main' => $bowl_main,
				'bowl_var' => $bowl_var,
				),
			array(
				'sort_by' => 'in:time,price,age,si,salary,experience,fielding,wicket,bat_seam,bat_spin,bowl_var,bowl_main',
				'age' => 'integer|min:1190|max:2520',
				'bat_style' => 'in:0,1,2',
				'bowl_style' => 'in:0,1,2',
				'xp' => 'integer|min:-1|max:20', 
				'si' => 'integer|min:-1',
				//'fitness' => 'in:0,1,2,3,4,5,6',
				'fielding' => 'integer|min:-1|max:20',
				'wicketkeeping' => 'integer|min:-1|max:20',
				'bat_seam' => 'integer|min:-1|max:20',
				'bat_spin' => 'integer|min:-1|max:20',
				'bowl_main' => 'integer|min:-1|max:20',
				'bowl_var' => 'integer|min:-1|max:20',
				)
			);

		if ($validator->fails())
    	{
    		var_dump($bowl_var);
   		    return Redirect::to('/index')->withErrors($validator);
    	}

    	switch ($bat_style) {
    		case '0':
    			$bat_query = '%%';
    			break;
    		case '1':
    			$bat_query = '%Right%';
    			break;
    		case '2':
    			$bat_query = '%Left%';
    			break;
    		default:
    			$bat_query = '%%';
    			break;
    	}

    	$ageFinal = $age ;

		$auctions = DB::table('auction')
						->join('players', 'auction.player_id', '=', 'players.player_id')
						->join('teams', 'auction.team_id', '=', 'teams.team_id')
						->select('auction.player_id',
								 'auction.team_id', 
								 'auction.age', 
								 'auction.experience', 
								 'auction.form', 
								 'auction.fitness', 
								 'auction.si', 
								 'auction.salary', 
								 'auction.price', 
								 'auction.time', 
								 'auction.fielding', 
								 'auction.wicket', 
								 'auction.bat_seam', 
								 'auction.bat_spin', 
								 'auction.bowl_main', 
								 'auction.bowl_var', 
								 'auction.checks', 
								 'auction.status', 
								 'teams.name AS teamname',
								 'players.bat_type',
								 'players.bowl_type',
								 'players.name AS playername')
						->where(function($query) use ($ageFinal,$age)
							{
								if ($age != 16) {
									$query->whereBetween('auction.age', array($ageFinal - 35, $ageFinal + 35));
								}
								
							}
						)
						->where(function($query) use ($xp)
							{
								if ($xp != -1) {
									$query->whereBetween('auction.experience', array($xp - 3, $xp + 3));
								}
								
							}
						)
						->where(function($query) use ($si)
							{
								$si_add = ((20/100) * $si );
								if ($si != -1) {
									$query->whereBetween('auction.si', array($si - $si_add, $si + $si_add));
								}
								
							}
						)
						->where(function($query) use ($fielding)
							{
								if ($fielding != -1) {
									$query->whereBetween('auction.fielding', array($fielding - 2, $fielding + 2));
								}
								
							}
						)
						->where(function($query) use ($wicketkeeping)
							{
								if ($wicketkeeping != -1) {
									$query->whereBetween('auction.wicket', array($wicketkeeping - 1, $wicketkeeping + 1));
								}
								
							}
						)
						->where(function($query) use ($bat_seam)
							{
								if ($bat_seam != -1) {
									$query->whereBetween('auction.bat_seam', array($bat_seam - 1, $bat_seam + 1));
								}
								
							}
						)
						->where(function($query) use ($bat_spin)
							{
								if ($bat_spin != -1) {
									$query->whereBetween('auction.bat_spin', array($bat_spin - 1, $bat_spin + 1));
								}
								
							}
						)
						->where(function($query) use ($bowl_main)
							{
								if ($bowl_main != -1) {
									$query->whereBetween('auction.bowl_main', array($bowl_main - 1, $bowl_main + 1));
								}
								
							}
						)
						->where(function($query) use ($bowl_var)
							{
								if ($bowl_var != -1) {
									$query->whereBetween('auction.bowl_var', array($bowl_var - 1, $bowl_var + 1));
								}
								
							}
						)
						->where('players.bat_type', 'LIKE', $bat_query)
						->where(function($query) use($bowl_style) {
							if ($bowl_style == '1') {
								$query->where('players.bowl_type', 'NOT LIKE', '%medium%')
									  ->where('players.bowl_type', 'NOT LIKE', '%fast%');
							} elseif($bowl_style == '2') {
								$query->where('players.bowl_type', 'LIKE', '%medium%')
									  ->orWhere('players.bowl_type', 'LIKE', '%fast%');
							} 
							
						})
						->orderBy('auction.status', 'DESC')
						->orderBy('auction.time','DESC')
						->remember(3)
						->paginate(20);

		$i = 0;
		$price = 0;
		foreach($auctions as $row){
			if($row->status != 0 && $i < 10){
				$price = $price + $row->price ;
				$i++;
			} else {
				break;
			}
		}
		$divide = $i == 0 ? "1" : $i ;
		$avg_price = ($price / $divide) == 0 ? "Not Found" : number_format($price / $divide) ;

		return View::make('quoteapi', array('auction' => $auctions, 'avg_price' => $avg_price));
	}

	public function getAuctionapi($id) 
	{
		$players = DB::table('auction')
						->where('player_id', "=", $id)
						->orderBy('id', 'desc')
						->take(1)
						->remember(5)
						->get();

		$output = array('status' => "error");

		foreach($players as $player)
		{
			$output['status'] = "success";
			$output['player_id'] = $player->player_id ;
			$output['team_id'] = $player->team_id ;
			$output['age'] = $player->age ;
			$output['xp'] = $player->experience ;
			$output['form'] = $player->form ;
			$output['fitness'] = $player->fitness ;
			$output['si'] = number_format($player->si) ;
			$output['salary'] = number_format($player->salary) ;
			$output['price'] = number_format($player->price) ;
			$output['time'] = date('H:i, D d M, Y', $player->time) ;
			$output['fielding'] = $player->fielding ;
			$output['wicket'] = $player->wicket ;
			$output['bat_seam'] = $player->bat_seam ;
			$output['bat_spin'] = $player->bat_spin ;
			$output['bowl_main'] = $player->bowl_main ;
			$output['bowl_var'] = $player->bowl_var ;
			$output['sell_status'] = $player->status ;
		}
		header('Access-Control-Allow-Origin: http://hitwicket.com');
		return Response::json($output);
	}

	public function getTrends()
	{
		//$time = "1402299540";
		$time = time();

		$starTime = $time - (60*60*24*7);

		$data = DB::table('auction')
					//->where('time', '>', $starTime)
					->whereBetween('time', array($starTime, $time))
					//->orderBy('time', 'ASC')
					->remember(10)
					->get();

		$oneHour = 60*60;
		$oneDay  = $oneHour * 24;
		
		$output = array(array(
							"Time",
							 date("l", $time),
							 date("l", $time + ($oneDay * 1)),
							 date("l", $time + ($oneDay * 2)),
							 date("l", $time + ($oneDay * 3)),
							 date("l", $time + ($oneDay * 4)),
							 date("l", $time + ($oneDay * 5)),
							 date("l", $time + ($oneDay * 6)),
						));
		$output2 = array(array(
							"Time",
							 date("l", $time),
							 date("l", $time + ($oneDay * 1)),
							 date("l", $time + ($oneDay * 2)),
							 date("l", $time + ($oneDay * 3)),
							 date("l", $time + ($oneDay * 4)),
							 date("l", $time + ($oneDay * 5)),
							 date("l", $time + ($oneDay * 6)),
						));
		$output3 = array(array(
							"Time",
							 date("l", $time),
							 date("l", $time + ($oneDay * 1)),
							 date("l", $time + ($oneDay * 2)),
							 date("l", $time + ($oneDay * 3)),
							 date("l", $time + ($oneDay * 4)),
							 date("l", $time + ($oneDay * 5)),
							 date("l", $time + ($oneDay * 6)),
						));
		$si = array(array("test","test","test","test","test","test","test","test"));
		$price = array(array("test","test","test","test","test","test","test","test"));
		$age = array(array("test","test","test","test","test","test","test","test"));
		$counter = array(array("test","test","test","test","test","test","test","test"));

		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$output[$i][$j] = 0;
				if($j == 0){ $output[$i][$j] = $i . ":00 hrs";}
			}
		}
		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$output2[$i][$j] = 0;
				if($j == 0){ $output2[$i][$j] = $i . ":00 hrs";}
			}
		}
		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$output3[$i][$j] = 0;
				if($j == 0){ $output3[$i][$j] = $i . ":00 hrs";}
			}
		}
		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$si[$i][$j] = 0;
				if($j == 0){ $si[$i][$j] = ($i + 0 );}
			}
		}
		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$price[$i][$j] = 0;
				if($j == 0){ $price[$i][$j] = ($i + 0 );}
			}
		}
		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$age[$i][$j] = 0;
				if($j == 0){ $age[$i][$j] = ($i + 0 );}
			}
		}
		for ($i=1; $i < 25; $i++) { 
			for ($j=0; $j < 8; $j++) { 
				$counter[$i][$j] = 1;
				if($j == 0){ $counter[$i][$j] = $i ;}
			}
		}

		foreach($data as $row)
		{
			/*
			for ($i=0; $i < ; $i++) { 
				if($row->time >= ($starTime + ((60*60)*($i))) && $row->time <= ($starTime + ((60*60)*($i + 1)))
			}
			*/
			$diff = $row->time - $starTime;
			//$day  = explode(".", ( $diff / $oneDay  ))[0];
			$day = round( $diff / $oneDay ); 
			//$hour = explode(".", ( $diff / $oneHour ))[0]; 
			$hour = round( $diff / $oneHour ); 
			//echo ($day % 7)."<br>";
			//$day = round(($hours / 24) - 0.5);
			//$hour = $hours % 24;

			$si[($hour % 24) + 1][($day % 7) + 1] = $si[($hour % 24) + 1][($day % 7) + 1] + $row->si ;
			$price[($hour % 24) + 1][($day % 7) + 1] = $price[($hour % 24) + 1][($day % 7) + 1] + $row->price ;
			$counter[($hour % 24) + 1][($day % 7) + 1] = $counter[($hour % 24) + 1][($day % 7) + 1] + 1 ;

			$output[($hour % 24) + 1][($day % 7) + 1] = round($price[($hour % 24) + 1][($day % 7) + 1] / $si[($hour % 24) + 1][($day % 7) + 1], 2)   ; 
			$output2[($hour % 24) + 1][($day % 7) + 1] = round($price[($hour % 24) + 1][($day % 7) + 1], 2) ;
			$output3[($hour % 24) + 1][($day % 7) + 1] = round(($si[($hour % 24) + 1][($day % 7) + 1] / $counter[($hour % 24) + 1][($day % 7) + 1]), 2) ;
		}

		//return var_dump($si);
		return View::make('trends', array(
									'priceVsSi' => json_encode($output),
									'priceVsHr' => json_encode($output2),
									'SiVsNo' => json_encode($output3),
									'title' => 'Auction Trends'));
	}
}