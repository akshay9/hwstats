@extends('layout.main')

@section('content')
<div class="col-md-8">
<ul class="pager">
  <li><a href="{{  URL::to('team/bat/')."/".$id }}">Bating</a></li>
  <li><a href="{{  URL::to('team/')."/".$id }}">Main</a></li>
  <li><a href="{{  URL::to('team/bowl/')."/".$id }}">Bowling</a></li>
</ul>
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
	<h2></h2>
	<table class="table table-striped">
		<tr>
			<th>Batsmen</th><th>Expereince</th><th>Form</th><th>Fitness</th><th>pitch</th><th>Ratting</th>
		</tr>
		<tbody>
			<?php $nm = ""; $pitch= ""; ?>
			@foreach($bat as $row)
				@if($pitch != $row->pitch || $nm != $row->name)
				<tr>
					<?php
					if ($nm != $row->name)
					{ 
						$age = round($row->age / 60)." yrs  ".($row->age % 60)." days";
						echo "<td 
							class=\"popover1\" 
							data-html=\"true\" 
							data-container=\"body\" 
							data-toggle=\"popover\" 
							data-original-title=\"Stats\" 
							data-trigger=\"hover\" 
							data-placement=\"right\" 
							data-content=\"
							<b>Age:</b> ".$age."<br>
							<b>SI:</b> ".$row->SI."<br>
							<b>Batting Style:</b> ".$row->bat_type."<br>\" >".$row->name."</td>" ; 
					}
					else
					{
						echo "<td></td>";
					}
					?>
					<td class="skill_{{ $row->experience }}">{{ Xp_level($row->experience) }}</td>
					<td class="secondary_skill_{{ $row->form }}">{{ skill_level($row->form) }}</td>
					<td class="secondary_skill_{{ $row->fitness }}">{{ skill_level($row->fitness) }}</td>
					<td>{{ $row->pitch }}</td>
					<td><span  data-toggle="tooltip" data-placement="bottom" title="Updated at: {{ $row->updated_at }}" class="stars" style="width:{{ ($row->ratting)*20 }}px"></span></td>
				</tr>
				@endif
				<?php $nm = $row->name; $pitch = $row->pitch; ?>
			@endforeach

		</tbody>
	</table>
	<br>
<ul class="pager">
  <li><a href="{{  URL::to('team/bat/')."/".$id }}">Bating</a></li>
  <li><a href="{{  URL::to('team/')."/".$id }}">Main</a></li>
  <li><a href="{{  URL::to('team/bowl/')."/".$id }}">Bowling</a></li>
</ul>
</div>

@stop
