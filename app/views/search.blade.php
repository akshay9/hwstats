@extends('layout.main')

@section('content')
<div class="col-md-12">
	<h1>Search : {{{ Input::get('search') }}}</h1>
<br><br>
	<h2>Players</h2>
	<table class="table table-striped">
		<tr>
			<th>ID</th><th>Name</th>
		</tr>
		<tbody>
			@foreach ($players  as $player)
			<tr>
				<td>{{ $player->player_id }}</td><td><a href="{{ URL::to('player/')."/".$player->player_id }}">{{ $player->name }}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $players->appends(array('search' => Input::get('search')))->links() }}

<br>
	<h2>Teams</h2>
	<table class="table table-striped">
		<tr>
			<th>ID</th><th>Name</th>
		</tr>
		<tbody>
			@foreach ($teams as $team)
			<tr>
				<td>{{ $team->team_id }}</td><td><a href="{{ URL::to('team/')."/".$team->team_id }}">{{ $team->name }}</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	{{ $teams->appends(array('search' => Input::get('search')))->links() }}
</div>
@stop