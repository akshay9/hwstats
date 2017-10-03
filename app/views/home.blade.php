@extends('layout.main')

@section('header')
<div class="row">
<div class="col-md-12">
<div class="alert alert-success">
 <div style="text-align: center;" class="center-block"><p><b>A site made just to make World a free Place !!<br> Cloning most of the Musketer Functions <br> Want to search a player or Team use the top right Search !!</b></p></div>
</div>
<div style="text-align: center;" class="alert alert-info"> Did You try the New <a href="/auction/quote" class="alert-link">Market Research </a>and <a href="/auction" class="alert-link">Enhanced Auction</a> Feature ?? </div>
</div>      
</div>

@stop

@section('content')
<div class="col-md-4 panel panel-default">
	<div class="panel-body">
	<div style="text-align: center;" class="center-block"><h2>Best Batsmen</h2></div>
	<br>
	@foreach ($bat as $row)
	<div class="panel panel-default">
 	 <div class="panel-heading">{{ Cache::rememberForever('player_'.$row->player_id, function() use ($row){ return Player::where('player_id','=', $row->player_id)->first()->name;}) }}  <a href="{{ URL::to('player/')."/".$row->player_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a></div>
 	 <div class="panel-body">
 	   <span  data-toggle="tooltip" data-placement="bottom" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->ratting)*20 }}px"></span>
	  </div>
	</div>
	<br>
	@endforeach
</div>
</div>
<div class="col-md-4 panel panel-default">
	<div class="panel-body">
	<div style="text-align: center;" class="center-block"><h2>Best Bowlers</h2></div>
	<br>
	@foreach ($bowl as $row)
	<div class="panel panel-default">
 	 <div class="panel-heading">{{ Cache::rememberForever('player_'.$row->player_id, function() use ($row){ return Player::where('player_id','=', $row->player_id)->first()->name;}) }}  <a href="{{ URL::to('player/')."/".$row->player_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a></div>
 	 <div class="panel-body">
 	   <span  data-toggle="tooltip" data-placement="bottom" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->rating)*20 }}px"></span>
	  </div>
	</div>
	<br>
	@endforeach
	</div>
</div>
<div class="col-md-4 panel panel-default">
	<div class="panel-body">
	<div style="text-align: center;" class="center-block"><h2>Best Fielding</h2></div>
	<br>
	@foreach ($field as $row)
	<div class="panel panel-default">
 	 <div class="panel-heading">{{ Cache::rememberForever('team_'.$row->team_id, function() use ($row){ return Team::where('team_id','=', $row->team_id)->first()->name;}) }}  <a href="{{ URL::to('team/')."/".$row->team_id }}" target="_blank"><span class="glyphicon glyphicon-new-window"></span></a></div>
 	 <div class="panel-body">
 	   <span  data-toggle="tooltip" data-placement="bottom" title="Updated at: {{ $row->created_at }}" class="stars" style="width:{{ ($row->fielding)*20 }}px"></span>
	  </div>
	</div>
	<br>
	@endforeach
	</div>
</div>
<!--<table class="table table-striped">
		@foreach ($bat as $row)
		<tr>
			<th>{{ $row->player_id }}</th>
		</tr>
		<tbody>
			<tr>
				<td>
					{{ $row->ratting }}
				</td>
			</tr>
		</tbody>
		@endforeach
	</table>
	-->
@stop