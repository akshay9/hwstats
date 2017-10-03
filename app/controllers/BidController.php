<?php

class BidController extends BaseController {

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
		
		$bids = DB::table('player_bids')
					->select('player_bids.id', 'player_bids.bidder', 'player_bids.player_name', 'teams.name', 'player_bids.bid', 'player_bids.deadline', 'player_bids.player_id')
					->leftJoin('teams', 'player_bids.player_id', '=', 'teams.team_id')
					->orderBy('bid','Asc')
					->get();

		//$team_names = DB::table('teams')
		//				->whereIn('team_id', function($query){
		//						$query->select('player_id')
		//							  ->from('player_bids');
		//					})
		//				->remember(36000)
		//				->get();

		//$team_names = DB::select('select * from users where player_id in (Select )', array(1));

		if(Auth::check()){
			$owned = DB::table('player_bids')
						->select('player_bids.id', 'teams.name', 'player_bids.bid')
						->join('teams', 'player_bids.player_id', '=', 'teams.team_id')
						->where('bidder' ,'=',  Auth::user()->id)
						->take(5);
			$moneyLeft = Auth::user()->money;

			return View::make('bid', array('auction_start' => mktime(0, 0, 0, 9, 23, 2014), 'money' => $moneyLeft, 'count' => $owned->count(), 'owner' => $owned->get(), 'bids' => $bids, 'title' => "Bid"));
		}
		
		return View::make('bid', array('auction_start' => mktime(0, 0, 0, 9, 23, 2014), 'bids' => $bids, 'title' => "Bid"));
	}

	public function getBidnew() 
	{
		if(Auth::check())
		{
			$bid_id = Input::get('id');
			$increment = Input::get('add');
			$validator = Validator::make(
					array('add' => $increment,
						  'id' => $bid_id
						  ),
					array('add' => 'required|in:1,5,10', 
						  'id' => 'required|integer'
						 )
					);
			if ($validator->fails())
    			{
    				return Redirect::to('/index');
    			}

			//$play_bid = DB::table('player_bids')
			//				->where('id', '=', $bid_id);

			//if($play_bid->count() != 0)
			//{
				$money = Auth::user()->money;
				$newbidderId = Auth::user()->id ;
				$data1 = DB::table('player_bids')->where('id', '=', $bid_id)->get();
				$data = $data1[0];
				if($data->bidder == $newbidderId){
					$money = $money + $data->bid;
				}
				//return var_dump($data);
				$newBid = $data->bid + ($increment * 1000000);
				if($newBid <= $money && $data->deadline >= time())
				{
					$current_Bid = $data->bid;
					$bidder = $data->bidder;

					if($data->deadline <= (time() + 180)){
						$newdeadline = time() + 180;
					} else {
						$newdeadline = $data->deadline;
					}

					DB::table('player_bids')
						->where('id', '=', $bid_id)
						->update(array('bid' => $newBid, 'bidder' => $newbidderId, 'deadline' => $newdeadline));

					//DB::table('users')
					//	->where('id' , '=', $bidder)
					//	->update(DB::raw('money = money + '.$current_Bid));
						//->increment('money', $current_Bid);
					DB::update('update users set money = money + ? where id = ?', array($current_Bid, $bidder));
					
					//DB::table('users')
					//	->where('id', '=', $newbidderId)
					//	->update(DB::raw('money = money - '.$newBid));
						//->decrement('money', $newBid);
					DB::update('update users set money = money - ? where id = ?', array($newBid, $newbidderId));

					return Redirect::to('bids')
            			->with('success', 'Bid successfully Increased');
				}
				return Redirect::to('bids')
            			->with('danger', 'Not enough Balance to Raise the Bid');
			//}
		}
		return Redirect::to('bids')
            			->with('danger', 'You need to be logged in to bid !');
	}

	public function getTime()
	{
		return mktime(0, 0, 0, 10, 5, 2014);
	}

	public function postAdduser()
	{
		if(!file_exists("addUser.lock")) {
		$validator = Validator::make(
				array('userid' => Input::get('userid'), 
					  'username' => Input::get('username'),
					  'bid' => Input::get('bid'),
					 ),
				array('userid' => 'required|integer|unique:player_bids,player_id',
					  'username' => 'required',
					  'bid' => 'required|integer',
					 )
			);
		if ($validator->fails())
    	{
    		return "Already Added or Something Went Wrong";
    	}
		DB::table('player_bids')
			->insert(array('player_id' => Input::get('userid'), 'player_name' => Input::get('username'), 'bid' => Input::get('bid'), 'deadline' => mktime(0, 0, 0, 9, 28, 2014)));
		return "Successfully Added !! <a href='/players.html'>Go Back</a>";
	}
	}
	
	public function getLock() 
	{
		$handle = fopen("addUser.lock", "w");
		fclose($handle);
		return "User Addition Locked !";
	}

}