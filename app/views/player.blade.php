@extends('layout.main')

@section('content')
<?php
function Xp_level($string){
	switch($string){
		case 0: 
			$level = "Non-existant"; 
			break;
		case 1:
			$level = "Horrible"; 
			break;
		case 2: 
			$level = "Hopeless"; 
			break;
		case 3: 
			$level = "Useless";
			break;
		case 4: 
			$level = "Mediocre";
			break;
		case 5: 
			$level = "Average"; 
			break;
		case 6: 
			$level = "Reliable"; 
			break;
		case 7: 
			$level = "Accomplished"; 
			break;
		case 8: 
			$level = "Remarkable"; 
			break;
		case 9: 
			$level = "Brilliant"; 
			break;
		case 10: 
			$level = "Exemplary"; 
			break;
		case 11: 
			$level = "Prodigious"; 
			break;
		case 12: 
			$level = "Fantastic"; 
			break;
		case 13: 
			$level = "Magnificent"; 
			break;
		case 14: 
			$level = "Masterful"; 
			break;
		case 15: 
			$level = "Supreme"; 
			break;
		case 16: 
			$level = "Magical"; 
			break;
		case 17: 
			$level = "Legendary"; 
			break;
		case 18: 
			$level = "Wonderous"; 
			break;
		case 19: 
			$level = "Demigod"; 
			break;
		case 20: 
			$level = "Titan"; 
			break;

	}
	return $level;
}
function skill_level($string){
	switch($string){
		case 1:
			$level = "Hopeless";
        break;
		case 2:
			$level = "Poor";
        break;
		case 3:
			$level = "Unreliable";
        break;
		case 4:
			$level = "Decent";
        break;
		case 5:
			$level = "Good";
        break;
		case 6:
			$level = "Superb";
        break;
	}
	return $level;
}
?>
<div class="col-md-8">
	<h1>{{ $player->name }}</h1>
	<h4>({{ Cache::rememberForever('team_'.$player->team_id, function() use ($player){ return Team::where('team_id','=', $player->team_id)->first()->name;}) }} <a href="{{ URL::to('team/')."/".$player->team_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a>)</h4>
	<br>
	<div class="well">
		He is a <strong>{{ round($player->age / 70)." yrs  ".($player->age % 70)." days"; }}</strong> old, {{ $player->bat_type }}, who bowls {{$player->bowl_type}}.<br>
		His experience level is <strong><span class="skill_{{ $player->experience }}">{{ Xp_level($player->experience) }}</span></strong> and currently in <strong><span class="secondary_skill_{{ $player->form }}">{{ skill_level($player->form) }}</span></strong> form & <strong><span class="secondary_skill_{{ $player->fitness }}">{{ skill_level($player->fitness) }}</span></strong> fitness. <br>
		His Skill Index is <strong>{{ number_format($player->SI) }}</strong>. </div>
	<br>

	<h2>Recent Bating Performances</h2>
	<table class="table table-striped">
		<tr>
			<th>Match</th>
			<th>Runs</th>
			<th>Ratting</th>
		</tr>
		<tbody>
			@foreach ($bat->get() as $row)
			<tr>
				<td>{{ $row->match_id }}</td>
				<td>{{ $row->runs }} ({{ $row->balls }})</td>
				<td><span  data-toggle="tooltip" data-placement="right" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->ratting)*20 }}px"></span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<br>

	<h2>Recent Bowling Performances</h2>
	<table class="table table-striped">
		<tr>
			<th>Match</th>
			<th>Runs</th>
			<th>Ratting</th>
		</tr>
		<tbody>
			@foreach ($bowl->get() as $row)
			<tr>
				<td>{{ $row->match_id }}</td>
				<td>{{ $row->runs }}/{{ $row->wickets }}</td>
				<td><span  data-toggle="tooltip" data-placement="right" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->rating)*20 }}px"></span></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@stop