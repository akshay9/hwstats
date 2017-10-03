@extends('layout.main')

@section('content')
<?php
//$auction_start = mktime(18, 45, 0, 8, 31, 2014);
?>
<div class="col-md-8">
	@if(Session::get('success') !== NULL)
		<div class="alert alert-success">{{Session::get('success')}}</div>
	@endif
	@if(Session::get('danger') !== NULL)
		<div class="alert alert-danger">{{Session::get('danger')}}</div>
	@endif
	@if (time() > $auction_start)
	@foreach($bids as $bid)
		@if($bid->deadline > time())
		<div class="panel panel-default">
  			<div class="panel-heading">
    			<h3 class="panel-title"><a href="http://hitwicket.com/team/show/{{$bid->player_id}}"> {{{ (isset($bid->name) ? $bid->name : $bid->player_name) }}}</a></h3>
  			</div>
  			<div class="panel-body">
    			<strong>Current Bid:</strong> {{ ($bid->bid)/1000000 }}M by {{{  User::find($bid->bidder)->name }}}<br><br>
    			<strong>Deadline: </strong>{{ date('H:i, D d M, Y', $bid->deadline) }} ({{ abs(round((( $bid->deadline - time())/(60*60)) - 0.5))." hrs ". abs(round(((($bid->deadline - time())%(60*60))/60) - 0.5)) }} mins left)<br>
    			<hr>
    			@if (Auth::check() && ($bid->bid + 1000000) <= $money)
    			<h4>Increment Bid</h4>
    			<a href="/bids/bidnew?id={{ $bid->id }}&add=1"><button type="button" class="btn btn-success btn-sm">+1M Bid</button></a>
    			@if (($bid->bid + 5000000) <= $money)
    			<a href="/bids/bidnew?id={{ $bid->id }}&add=5"><button type="button" class="btn btn-warning btn-sm">+5M Bid</button></a>
    			@endif
    			@if (($bid->bid + 10000000) <= $money)
    			<a href="/bids/bidnew?id={{ $bid->id }}&add=10"><button type="button" class="btn btn-danger btn-sm">+10M Bid</button></a>
    			@endif
    			@endif
  			</div>
		</div>
		@endif
	@endforeach
	@else
		<div class="alert alert-warning">Auction will start at <strong>{{ date('H:i, D d M, Y', $auction_start) }}</strong></div>
	@endif
</div>
<div class="col-md-4">
	@if(!Auth::check())
		<h2>Login</h2><br>
		{{ Session::get('message') }}
		{{ Form::open(array('action' => 'UsersController@postLogin')) }}
		<div class="form-group">
			{{ Form::label('username', 'Username') }}
			{{ Form::text('username') }}
		</div>
		<div class="form-group">
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password') }}
		</div>
		<div class="checkbox">	
			{{ Form::label('remember', 'Remember Me') }}
			{{ Form::checkbox('remember', 'remember')}}
		</div>
		{{ Form::submit('Submit', array('class' => "btn btn-default")) }}
		{{ Form::close() }}
	@else
		<h2>Panel</h2>
		{{ Session::get('message') }}
		<br><strong>Players Owned:</strong> {{ $count > 4 ? '4+':$count }} / 3<br>
		<br><strong>Money Left:</strong> {{ ($money)/1000000 }}M<br>
		<br><a href="/users/logout">Logout</a><br>
		<h3>My current bids (Top 5)</h3>
		@foreach ($owner as  $value) 
			<strong>{{ $value->name }}</strong> at <strong>Rs. {{ $value->bid/1000000 }}M</strong><br>
		@endforeach
	@endif
</div>
@stop