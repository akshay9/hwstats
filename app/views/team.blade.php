@extends('layout.main')

@section('content')
<div class="col-md-8">
<ul class="pager">
  <li><a href="{{  URL::to('team/bat/')."/".$id }}">Bating</a></li>
  <li><a href="{{  URL::to('team/')."/".$id }}">Main</a></li>
  <li><a href="{{  URL::to('team/bowl/')."/".$id }}">Bowling</a></li>
</ul>
	
	<h1>{{ Cache::rememberForever('team_'.$id, function() use ($id){ 
						return Team::where('team_id','=', $id)->first()->name;}); }}</h1>
	<br>
	<h2>Recent Matches</h2>
	<table class="table table-striped">
		<tr>
			<th>Match</th><th>Team 1</th><th>Team 2</th><th>Results</th>
		</tr>
		<tbody>
			@foreach ($matches as $row)
				<?php
					$team1 = Cache::rememberForever('team_'.$row->team1_id, function() use ($row){ 
						return Team::where('team_id','=', $row->team1_id)->first()->name;});
					$team2 = Cache::rememberForever('team_'.$row->team2_id, function() use ($row){ 
						return Team::where('team_id','=', $row->team2_id)->first()->name;});

					if ($row->team1_runrate > $row->team2_runrate) {
						$winner = $team1." Won";
						$winnerID = $row->team1_id;
						if($id==$winnerID){ $class="success"; }
						else{ $class="danger"; }
					} elseif($row->team1_runrate < $row->team2_runrate) {
						$winner = $team2." Won";
						$winnerID = $row->team2_id;
						if($id==$winnerID){ $class="success"; }
						else { $class="danger"; }
					} else {
						$winner = "Match Tied";
						$winnerID = $row->team2_id;
						$class = "warning";
					}
					
				?>
				<tr class="{{ $class }}">
					<td><a href="{{ URL::to('match/')."/".$row->match_id }}" target"_blank">{{ $team1." vs ".$team2 }}</a></td>
					<td><span class="tooltip1" data-toggle="tooltip" data-placement="bottom" title="{{ $team1 }}">{{ $row->team1_runs."/".$row->team1_wickets }}</span></td>
					<td> <span class="tooltip1" data-toggle="tooltip" data-placement="bottom" title="{{ $team2 }}">{{ $row->team2_runs."/".$row->team2_wickets }}</span></td>
					<td>{{ $winner }}</td> 
				</tr>
			@endforeach
		</tbody>
	</table>
	<br>

	<h2>Fielding</h2>
	<table class="table table-striped">
		<tr>
			<th>As on</th>
			<th>Runs Saved</th>
			<th>Misfields</th>
			<th>Byes</th>
			<th>Fielding</th>
			<th>WicketKeeping</th>
		</tr>
		<tbody>
			@foreach ($field as $row)
				<tr>
					<td>{{ date('j M y', strtotime($row->created_at)) }}</td>
					<td>{{ $row->runs_saved }}</td>
					<td>{{ $row->misfields }}</td>
					<td>{{ $row->byes }}</td>
					<td><span  data-toggle="tooltip" data-placement="bottom" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->fielding)*20 }}px"></span></td>
					<td><span  data-toggle="tooltip" data-placement="bottom" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->wicketkeeping)*20 }}px"></span></td>
				</tr>
			@endforeach
		</tbody>
	</table>


<ul class="pager">
  <li><a href="{{  URL::to('team/bat/')."/".$id }}">Bating</a></li>
  <li><a href="{{  URL::to('team/')."/".$id }}">Main</a></li>
  <li><a href="{{  URL::to('team/bowl/')."/".$id }}">Bowling</a></li>
</ul>
</div>
@stop