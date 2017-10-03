@extends('layout.main')

@section('content')
<?php

function getovers($balls){
	$overs[0] = round($balls / 6);
	$overs[1] = $balls % 6 ;
	$over = $overs[0].".".$overs[1];
	return $over;
}

?>
<div class="col-md-6">
	<h2>{{ Cache::rememberForever('team_'.$match->team1_id, function() use ($match){ return Team::where('team_id','=', $match->team1_id)->first()->name;}) }} <a href="{{ URL::to('team/')."/".$match->team1_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>  ({{ $match->team1_runs }}/{{ $match->team1_wickets }}) RR: {{ round($match->team1_runrate,2) }}</h2>
	<table class="table table-striped">
		<tr>
			<th>Batsmen</th> <th>Runs</th><th>Balls</th><th>6s</th><th>4s</th><th>Ratting</th>
		</tr>
		<tbody>
			@foreach($bats1 as $row)
				@if($row->inning == 1)
				<tr>
					<td>{{ Cache::rememberForever('player_'.$row->player_id, function() use ($row){ return Player::where('player_id','=', $row->player_id)->first()->name;}) }}</tD><td>{{ $row->runs }}</td><td>{{ $row->balls }}</td><td>{{ $row['6s'] }}</td><td>{{ $row['4s'] }}</td><td><span class="stars" style="width:{{ ($row->ratting)*20 }}px"></span></td>
				</tr>
				@endif
			@endforeach

		</tbody>
	</table>
	<br>
	<table class="table table-striped">
		<tr>
			<th>Bowler</th> <th>Runs</th><th>Overs</th><th>wickets</th><th>Ratting</th>
		</tr>
		<tbody>
			@foreach($bowl1 as $row)
				@if($row->inning == 1)
				<tr>
					<td>{{ Cache::rememberForever('player_'.$row->player_id, function() use ($row){ return Player::where('player_id','=', $row->player_id)->first()->name;}) }}</tD><td>{{ $row->runs }}</td><td>{{ getovers($row->balls) }}</td><td>{{ $row->wickets }}</td><td><span class="stars" style="width:{{ ($row->rating)*20 }}px"></span></td>
				</tr>
				@endif
			@endforeach

		</tbody>
	</table>
	<br>
	<table class="table">
		<tr>
			<td>Fielding:</td>
			<td><span class="stars" style="width:{{ ($fielding[0]->fielding)*20 }}px"></span></td>
		</tr>
		<tr>
			<td>WicketKepping:</td>
			<td><span class="stars" style="width:{{ ($fielding[0]->wicketkeeping)*20 }}px"></span></td>
		</tr>
		<tr>
			<td>Runs Saved:</td>
			<td>{{ $fielding[0]->runs_saved }}</td>
		</tr>
		<tr>
			<td>Misfields:</td>
			<td>{{ $fielding[0]->misfields }}</td>
		</tr>
		<tr>
			<td>Byes:</td>
			<td>{{ $fielding[0]->byes }}</td>
		</tr>
	</table>
</div>
<div class="col-md-6">
	<h2>{{ Cache::rememberForever('team_'.$match->team2_id, function() use ($match){ return Team::where('team_id','=', $match->team2_id)->first()->name;}) }} <a href="{{ URL::to('team/')."/".$match->team2_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a> ({{ $match->team2_runs }}/{{ $match->team2_wickets }})  RR: {{ round($match->team2_runrate,2) }}</h2>
	<table class="table table-striped">
		<tr>
			<th>Batsmen</th> <th>Runs</th><th>Balls</th><th>6s</th><th>4s</th><th>Ratting</th>
		</tr>
		<tbody>
			@foreach($bats1 as $row)
				@if($row->inning == 2)
				<tr>
					<td>{{ Cache::rememberForever('player_'.$row->player_id, function() use ($row){ return Player::where('player_id','=', $row->player_id)->first()->name;}) }}</tD><td>{{ $row->runs }}</td><td>{{ $row->balls }}</td><td>{{ $row['6s'] }}</td><td>{{ $row['4s'] }}</td><td><span class="stars" style="width:{{ ($row->ratting)*20 }}px"></span></td>
				</tr>
				@endif
			@endforeach

		</tbody>
	</table>
	<br>
	<table class="table table-striped">
		<tr>
			<th>Bowler</th> <th>Runs</th><th>Overs</th><th>wickets</th><th>Ratting</th>
		</tr>
		<tbody>
			@foreach($bowl1 as $row)
				@if($row->inning == 2)
				<tr>
					<td>{{ Cache::rememberForever('player_'.$row->player_id, function() use ($row){ return Player::where('player_id','=', $row->player_id)->first()->name;}) }}</tD><td>{{ $row->runs }}</td><td>{{ getovers($row->balls) }}</td><td>{{ $row->wickets }}</td><td><span class="stars" style="width:{{ ($row->rating)*20 }}px"></span></td>
				</tr>
				@endif
			@endforeach

		</tbody>
	</table>
	<br>
	<table class="table">
		<tr>
			<td>Fielding:</td>
			<td><span class="stars" style="width:{{ ($fielding[1]->fielding)*20 }}px"></span></td>
		</tr>
		<tr>
			<td>WicketKepping:</td>
			<td><span class="stars" style="width:{{ ($fielding[1]->wicketkeeping)*20 }}px"></span></td>
		</tr>
		<tr>
			<td>Runs Saved:</td>
			<td>{{ $fielding[1]->runs_saved }}</td>
		</tr>
		<tr>
			<td>Misfields:</td>
			<td>{{ $fielding[1]->misfields }}</td>
		</tr>
		<tr>
			<td>Byes:</td>
			<td>{{ $fielding[1]->byes }}</td>
		</tr>
	</table>
</div>
@stop
